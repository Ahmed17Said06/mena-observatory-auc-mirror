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
    protected $signature = 'aswat:dedupe
        {--apply : Delete the duplicate "Student N" records}
        {--apply-all : Delete every same-video duplicate, keeping the best copy}
        {--students : Target the "Student N"-titled records (report; add --apply to delete)}
        {--list : Just list all Aswat records (id, title, link)}';
    protected $description = 'Report (and optionally remove) duplicate Aswat videos that share the same video link';

    public function handle(): int
    {
        if ($this->option('list')) {
            foreach (Aswat::orderBy('id')->get() as $a) {
                $this->line(sprintf('#%-4d [%s] %s  ->  %s',
                    $a->id, $a->thumbnail_image ? 'thumb' : 'no-thumb', $a->title, $a->link));
            }
            return self::SUCCESS;
        }

        // Directly target the "Student N" records by title (they are standalone
        // re-uploads, so link-grouping won't pair them with the renamed videos).
        if ($this->option('students')) {
            $apply = (bool) $this->option('apply');
            $students = Aswat::orderBy('id')->get()->filter(fn($a) => $this->isStudent($a->title));
            if ($students->isEmpty()) {
                $this->info('No "Student N" records found.');
                return self::SUCCESS;
            }
            foreach ($students as $s) {
                $this->warn(($apply ? 'DELETE  ' : 'would delete ') . sprintf('#%-4d "%s"  ->  %s', $s->id, $s->title, $s->link));
                if ($apply) $s->delete();
            }
            $this->newLine();
            $this->info($apply
                ? "Deleted {$students->count()} Student record(s)."
                : "{$students->count()} Student record(s) above. Re-run with --students --apply to delete them.");
            return self::SUCCESS;
        }

        $apply    = (bool) $this->option('apply');
        $applyAll = (bool) $this->option('apply-all');

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

            if ($applyAll) {
                // Keep the best copy of the whole group, delete the rest.
                $keeper = $this->bestKeeper($rows);
                $this->info("   keep    #{$keeper->id}  \"{$keeper->title}\"");
                foreach ($rows as $r) {
                    if ($r->id === $keeper->id) continue;
                    $this->warn("   DELETE  #{$r->id}  \"{$r->title}\"");
                    $r->delete();
                    $deleted++;
                }
            } elseif ($named->isNotEmpty() && $students->isNotEmpty()) {
                // Only auto-remove when there is a clear named keeper AND student dupes.
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
                $this->line('   (no clear "Student N" duplicate — re-run with --apply-all to keep one copy)');
            }
        }

        $this->newLine();
        if ($dupGroups === 0) {
            $this->info('No duplicate video groups found.');
        } elseif ($apply || $applyAll) {
            $this->info("Removed {$deleted} duplicate record(s) across {$dupGroups} group(s).");
        } else {
            $this->info("Found {$dupGroups} duplicate group(s). Re-run with --apply (Student dupes) or --apply-all (keep one copy of each).");
        }

        return self::SUCCESS;
    }

    /** Pick the record to keep in a same-video group: prefer a thumbnail, then a
     *  clean (no stray whitespace) and more descriptive title, then lowest id. */
    private function bestKeeper($rows)
    {
        return $rows->sortBy(fn($r) => [
            $r->thumbnail_image ? 0 : 1,          // has thumbnail first
            $r->title === trim($r->title) ? 0 : 1, // no stray leading/trailing space
            -Str::length(trim((string) $r->title)),// longer/more descriptive
            $r->id,                                // stable tiebreak
        ])->first();
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
