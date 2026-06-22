<?php

namespace App\Console\Commands;

use App\Models\Repo;
use App\Models\Repo_type;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

/**
 * Auto-derive the Knowledge Hub repo_type for every resource from its tags and
 * title, using the same rule as the spreadsheet importer:
 *
 *   - a "Blog Post" tag                              → Blogpost
 *   - a "Policy" tag, or a title containing
 *     charter / policy / brief / roadmap             → Policy
 *   - otherwise                                      → Report
 *
 * Safe by default: previews the changes (dry-run). Pass --apply to write.
 *
 *   php artisan repos:recategorize                 # preview only
 *   php artisan repos:recategorize --apply         # write changes
 *   php artisan repos:recategorize --only-empty    # only repos with no type yet
 */
class RecategorizeRepos extends Command
{
    protected $signature = 'repos:recategorize
        {--apply : Persist the changes (otherwise dry-run preview only)}
        {--only-empty : Only set a type for repos that currently have none (do not overwrite)}';

    protected $description = 'Auto-derive Knowledge Hub repo_type (Blogpost/Policy/Report) from tags and title';

    public function handle(): int
    {
        $apply     = (bool) $this->option('apply');
        $onlyEmpty = (bool) $this->option('only-empty');

        // Resolve canonical type ids once.
        $ids = [
            'Blogpost' => Repo_type::firstOrCreate(['name' => 'Blogpost'])->id,
            'Policy'   => Repo_type::firstOrCreate(['name' => 'Policy'])->id,
            'Report'   => Repo_type::firstOrCreate(['name' => 'Report'])->id,
        ];
        $nameById = array_flip($ids);

        $changes = 0;
        $rows = [];

        Repo::with('tags')->chunkById(200, function ($repos) use (&$changes, &$rows, $ids, $nameById, $onlyEmpty) {
            foreach ($repos as $r) {
                if ($onlyEmpty && ! empty($r->repo_type_id)) {
                    continue;
                }

                $targetName = $this->deriveType($r->tags->pluck('name')->all(), (string) $r->title);
                $targetId   = $ids[$targetName];

                if ((int) $r->repo_type_id === (int) $targetId) {
                    continue; // already correct
                }

                $fromName = $nameById[$r->repo_type_id] ?? ($r->repo_type_id ? "#{$r->repo_type_id}" : '—');
                $rows[] = [$r->id, Str::limit($r->title, 60), $fromName, $targetName];
                $changes++;

                if ($this->option('apply')) {
                    $r->repo_type_id = $targetId;
                    $r->save();
                }
            }
        });

        if (empty($rows)) {
            $this->info('Nothing to change — every repo already has the derived type.');
            return self::SUCCESS;
        }

        $this->table(['ID', 'Title', 'From', 'To'], $rows);

        if ($apply) {
            $this->info("Applied {$changes} category change(s).");
        } else {
            $this->warn("{$changes} repo(s) would change. Re-run with --apply to persist.");
        }

        return self::SUCCESS;
    }

    private function deriveType(array $tags, string $title): string
    {
        $lowerTags = array_map('strtolower', $tags);

        if (in_array('blog post', $lowerTags, true)) {
            return 'Blogpost';
        }
        if (in_array('policy', $lowerTags, true)
            || Str::contains(Str::lower($title), ['charter', 'policy', 'brief', 'roadmap'])) {
            return 'Policy';
        }
        return 'Report';
    }
}
