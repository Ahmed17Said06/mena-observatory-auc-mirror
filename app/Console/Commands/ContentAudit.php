<?php

namespace App\Console\Commands;

use App\Models\Blogs;
use App\Models\News;
use App\Models\Repo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Read-only content quality audit across the Knowledge Hub (repo), News and
 * Blog Posts. Produces a CSV worklist flagging the common problems:
 *
 *   - missing_image     : no image set
 *   - broken_image      : image path set but the file is missing on disk
 *   - no_destination    : clicking the item leads to an empty/sparse internal
 *                         page (repo with no data_link/PDF; news with no link
 *                         and no content)
 *   - duplicate_link    : the outbound link is shared by 2+ other items (the
 *                         "everything opens the same page" symptom)
 *   - no_category       : repo has no repo_type assigned
 *
 *   php artisan content:audit                 # writes storage/app/content-audit.csv
 *   php artisan content:audit --only=repo     # repo | news | blog (comma-sep)
 *   php artisan content:audit --out=/tmp/a.csv
 */
class ContentAudit extends Command
{
    protected $signature = 'content:audit
        {--only= : Comma-separated subset to scan: repo,news,blog}
        {--out= : Output CSV path (default: storage/app/content-audit.csv)}';

    protected $description = 'Audit Knowledge Hub / News / Blog content for missing images, dead links and miscategorisation';

    public function handle(): int
    {
        $only = collect(explode(',', (string) $this->option('only')))
            ->map(fn ($s) => trim(strtolower($s)))
            ->filter()
            ->all();
        $want = fn (string $t) => empty($only) || in_array($t, $only, true);

        $rows = [];
        if ($want('repo'))  { $rows = array_merge($rows, $this->auditRepos()); }
        if ($want('news'))  { $rows = array_merge($rows, $this->auditNews()); }
        if ($want('blog'))  { $rows = array_merge($rows, $this->auditBlogs()); }

        // Cross-row duplicate-link detection (within the audited set).
        $this->flagDuplicateLinks($rows);

        $out = $this->option('out') ?: storage_path('app/content-audit.csv');
        $this->writeCsv($out, $rows);

        $this->summarise($rows, $out);

        return self::SUCCESS;
    }

    /** Knowledge Hub resources. */
    private function auditRepos(): array
    {
        $rows = [];
        Repo::with(['repoType', 'tags'])->chunkById(200, function ($repos) use (&$rows) {
            foreach ($repos as $r) {
                $bucket = $r->is_our_work ? 'Our Work' : ($r->is_global ? 'Global' : 'Regional');
                $category = optional($r->repoType)->name;

                // The clickable destination: data_link, else an attached PDF.
                $link = $r->data_link ?: ($r->en_pdf ? Storage::url($r->en_pdf) : ($r->ar_pdf ? Storage::url($r->ar_pdf) : ''));

                $issues = [];
                [$imgState] = $this->imageState($r->image);
                if ($imgState === 'empty')  { $issues[] = 'missing_image'; }
                if ($imgState === 'broken') { $issues[] = 'broken_image'; }
                if (! $r->data_link && ! $r->en_pdf && ! $r->ar_pdf && ! $r->file && ! $r->content) {
                    $issues[] = 'no_destination';
                }
                if (empty($r->repo_type_id)) { $issues[] = 'no_category'; }

                $rows[] = [
                    'type'        => 'repo',
                    'id'          => $r->id,
                    'title'       => $r->title,
                    'bucket'      => $bucket,
                    'category'    => $category,
                    'tags'        => $r->tags->pluck('name')->implode('; '),
                    'link'        => $link,
                    'image'       => $r->image,
                    'image_state' => $imgState,
                    'issues'      => $issues,           // duplicate_link added later
                    'admin'       => '/admin/repos/' . $r->id . '/edit',
                ];
            }
        });
        return $rows;
    }

    /** News (incl. Global AI News). */
    private function auditNews(): array
    {
        $rows = [];
        News::query()->chunkById(200, function ($items) use (&$rows) {
            foreach ($items as $n) {
                $issues = [];
                [$imgState] = $this->imageState($n->image);
                if ($imgState === 'empty')  { $issues[] = 'missing_image'; }
                if ($imgState === 'broken') { $issues[] = 'broken_image'; }
                // News::single() redirects to data_link; with neither link nor
                // content there is nothing meaningful to show.
                if (! $n->data_link && ! $n->content) { $issues[] = 'no_destination'; }

                $rows[] = [
                    'type'        => 'news',
                    'id'          => $n->id,
                    'title'       => $n->title,
                    'bucket'      => $n->featured === 'global_ai' ? 'Global AI News' : 'News',
                    'category'    => $n->featured,
                    'tags'        => '',
                    'link'        => (string) $n->data_link,
                    'image'       => $n->image,
                    'image_state' => $imgState,
                    'issues'      => $issues,
                    'admin'       => '/admin/news/' . $n->id . '/edit',
                ];
            }
        });
        return $rows;
    }

    /** Blog posts (internal detail pages; no outbound link). */
    private function auditBlogs(): array
    {
        $rows = [];
        Blogs::query()->chunkById(200, function ($items) use (&$rows) {
            foreach ($items as $b) {
                $issues = [];
                [$imgState] = $this->imageState($b->image);
                if ($imgState === 'empty')  { $issues[] = 'missing_image'; }
                if ($imgState === 'broken') { $issues[] = 'broken_image'; }

                $rows[] = [
                    'type'        => 'blog',
                    'id'          => $b->id,
                    'title'       => $b->title,
                    'bucket'      => 'Blog',
                    'category'    => '',
                    'tags'        => '',
                    'link'        => '',   // internal page, never duplicate
                    'image'       => $b->image,
                    'image_state' => $imgState,
                    'issues'      => $issues,
                    'admin'       => '/admin/blogs/' . $b->id . '/edit',
                ];
            }
        });
        return $rows;
    }

    /** Returns [state] where state is ok | empty | broken | external. */
    private function imageState(?string $path): array
    {
        $path = trim((string) $path);
        if ($path === '') { return ['empty']; }
        if (Str::startsWith($path, ['http://', 'https://'])) { return ['external']; }

        $normalized = Str::startsWith($path, 'storage/') ? substr($path, 8) : $path;
        $exists = Storage::disk('public')->exists($normalized)
            || file_exists(public_path($path));

        return [$exists ? 'ok' : 'broken'];
    }

    /** Mark every row whose non-empty link is shared by another row. */
    private function flagDuplicateLinks(array &$rows): void
    {
        $counts = [];
        foreach ($rows as $r) {
            $link = trim((string) $r['link']);
            if ($link === '') { continue; }
            $counts[$link] = ($counts[$link] ?? 0) + 1;
        }
        foreach ($rows as &$r) {
            $link = trim((string) $r['link']);
            if ($link !== '' && ($counts[$link] ?? 0) > 1) {
                $r['issues'][] = 'duplicate_link';
            }
        }
        unset($r);
    }

    private function writeCsv(string $path, array $rows): void
    {
        @mkdir(dirname($path), 0775, true);
        $fh = fopen($path, 'w');
        fputcsv($fh, ['type', 'id', 'title', 'bucket', 'category', 'tags', 'link', 'image', 'image_state', 'issues', 'admin_edit']);
        foreach ($rows as $r) {
            fputcsv($fh, [
                $r['type'], $r['id'], $r['title'], $r['bucket'], $r['category'],
                $r['tags'], $r['link'], $r['image'], $r['image_state'],
                implode('|', $r['issues']), $r['admin'],
            ]);
        }
        fclose($fh);
    }

    private function summarise(array $rows, string $out): void
    {
        $total   = count($rows);
        $flagged = collect($rows)->filter(fn ($r) => ! empty($r['issues']));

        $byIssue = [];
        foreach ($rows as $r) {
            foreach ($r['issues'] as $i) { $byIssue[$i] = ($byIssue[$i] ?? 0) + 1; }
        }

        $this->info("Audited {$total} items — " . $flagged->count() . ' have at least one issue.');
        $this->line('');
        foreach ($byIssue as $issue => $count) {
            $this->line(sprintf('  %-16s %d', $issue, $count));
        }
        $this->line('');
        $this->info("CSV written to: {$out}");
        $this->line('Open it in Excel and sort by the "issues" column to build your worklist.');
    }
}
