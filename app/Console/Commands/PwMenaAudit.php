<?php

namespace App\Console\Commands;

use App\Models\PwMenaPublication;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

/**
 * Read-only dump of the Future-of-Work (pw_mena_publications) entries so the
 * exact current state — ids, titles and which EN/AR/FR outputs are attached —
 * can be reviewed before merging/renaming/deleting any rows.
 *
 *   php artisan pwmena:audit
 *   php artisan pwmena:audit --type=report   # report | brief | blog | webinar | educational
 */
class PwMenaAudit extends Command
{
    protected $signature = 'pwmena:audit {--type= : Limit to one type}';
    protected $description = 'List Future-of-Work publications with their EN/AR/FR outputs (read-only)';

    public function handle(): int
    {
        $q = PwMenaPublication::query()->orderBy('type')->orderBy('sort_order')->orderBy('id');
        if ($this->option('type')) {
            $q->where('type', $this->option('type'));
        }

        $rows = $q->get();
        if ($rows->isEmpty()) {
            $this->warn('No pw_mena_publications rows found.');
            return self::SUCCESS;
        }

        $mark = fn ($v) => $v ? 'Y' : '-';

        foreach ($rows as $p) {
            $this->line(str_repeat('─', 70));
            $this->line("#{$p->id}  [{$p->type}]  sort={$p->sort_order}");
            $this->line('  title    : ' . $p->title);
            $this->line('  ar_title : ' . ($p->ar_title ?: '—'));
            $this->line(sprintf(
                '  outputs  : EN[%s] AR[%s] FR[%s] external[%s]',
                $mark($p->file_en ?: $p->link_en),
                $mark($p->file_ar ?: $p->link_ar),
                $mark($p->file_fr ?: $p->link_fr),
                $mark($p->external_link)
            ));
            // Show the actual stored values so links can be reused when merging.
            foreach (['link_en','file_en','link_ar','file_ar','link_fr','file_fr','external_link'] as $col) {
                if (!empty($p->$col)) {
                    $this->line(sprintf('    %-13s = %s', $col, Str::limit($p->$col, 90)));
                }
            }
        }

        $this->line(str_repeat('─', 70));
        $this->info($rows->count() . ' publication(s). Types: '
            . $rows->groupBy('type')->map->count()->map(fn($c,$t)=>"$t=$c")->implode('  '));

        return self::SUCCESS;
    }
}
