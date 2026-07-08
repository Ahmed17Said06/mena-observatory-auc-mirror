<?php

namespace App\Console\Commands;

use App\Models\Aswat;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

/**
 * Finds Aswat videos that point to the SAME underlying video (same YouTube /
 * Google Drive id, or identical link) and reports the duplicate groups.
 *
 * When a group contains both a properly-titled record and a generic
 * "Student N" record, the "Student N" one is treated as the leftover old copy
 * and removed (only with --apply). Groups without that clear pattern are
 * reported but never auto-deleted.
 *
 *     php artisan aswat:dedupe            # report only (safe, default)
 *     php artisan aswat:dedupe --apply    # actually delete the student duplicates
 */
class AswatDedupe extends Command
{
    protected $signature = 'aswat:dedupe {--apply : Delete the duplicate "Student N" records}';
    protected $description = 'Report (and optionally remove) duplicate Aswat videos that share the same video link';

    public function handle(): int
    {
        $apply = (bool) $this->option('apply');

        $groups = Aswat::orderBy('id')->get()->groupBy(fn($a) => $this->videoKey($a->link));

        $dupGroups = 0; $deleted = 0;

        foreach ($groups as $key => $rows) {
            if ($rows->count() < 2) {
                continue;
            }
            $dupGroups++;
            $this->newLine();
            $this->line("Duplicate group (video: {$key}):");
            foreach ($rows as $r) {
                $this->line(sprintf('   #%-4d "%s"', $r->id, $r->title));
            }

            $students = $rows->filter(fn($r) => $this->isStudent($r->title));
            $named     = $rows->reject(fn($r) => $this->isStudent($r->title));

            // Only auto-remove when there is a clear named keeper AND student dupes.
            if ($named->isNotEmpty() && $students->isNotEmpty()) {
                // Prefer a keeper that has a thumbnail, else the lowest id.
                $keeper = $named->sortByDesc(fn($r) => $r->thumbnail_image ? 1 : 0)->first();
                $this->info("   keep    #{$keeper->id}  \"{$keeper->title}\"");
                foreach ($students as $s) {
                    $this->warn(($apply ? '   DELETE  ' : '   would delete ') . "#{$s->id}  \"{$s->title}\"");
                    if ($apply) {
                        $s->delete();
                        $deleted++;
                    }
                }
            } else {
                $this->line('   (no clear "Student N" duplicate here — left untouched)');
            }
        }

        $this->newLine();
        if ($dupGroups === 0) {
            $this->info('No duplicate video groups found.');
        } else {
            $this->info(($apply ? "Removed {$deleted} duplicate record(s) across {$dupGroups} group(s)."
                                : "Found {$dupGroups} duplicate group(s). Re-run with --apply to remove the Student duplicates."));
        }

        return self::SUCCESS;
    }

    private function isStudent(?string $title): bool
    {
        return (bool) preg_match('/^\s*student\s*\d*\s*$/i', (string) $title);
    }

    /** Stable identity for a video: YouTube id, Drive file id, else the trimmed link. */
    private function videoKey(?string $link): string
    {
        $link = trim((string) $link);
        if ($link === '') {
            return 'empty-' . uniqid();
        }
        if (preg_match('~(?:youtube\.com/(?:watch\?v=|embed/|shorts/)|youtu\.be/)([A-Za-z0-9_-]{11})~', $link, $m)) {
            return 'yt:' . $m[1];
        }
        if (preg_match('~drive\.google\.com/(?:file/d/|open\?id=|uc\?id=)([A-Za-z0-9_-]+)~', $link, $m)) {
            return 'drive:' . $m[1];
        }
        return 'url:' . Str::lower(rtrim($link, '/'));
    }
}
