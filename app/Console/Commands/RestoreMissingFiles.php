<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Audits every stored file/PDF/image path in the database against the public
 * disk (storage/app/public) and, for anything missing locally, pulls it back
 * from the legacy host. Re-runnable and idempotent: files that already exist
 * are left untouched.
 *
 *   php artisan files:restore-missing --dry-run     # report only
 *   php artisan files:restore-missing               # report + download
 *   php artisan files:restore-missing --only=repo,pdf_files
 */
class RestoreMissingFiles extends Command
{
    protected $signature = 'files:restore-missing
        {--source=https://34.166.132.99/storage : Base URL the missing files are pulled from}
        {--dry-run : Only report what is missing, do not download}
        {--only= : Comma-separated list of tables to limit the scan to}
        {--fix-prefixes : Strip a leading "storage/" from every mapped column and exit (fixes /storage/storage/ 404s)}';

    protected $description = 'Audit DB file/PDF/image paths and restore any missing from the legacy host';

    /** Table => columns that hold a path on the public disk. */
    private array $map = [
        'repo'                  => ['image', 'file', 'ar_pdf', 'en_pdf'],
        'pdf_files'             => ['image', 'file'],
        'additional_resources'  => ['image', 'file'],
        'policy_briefs'         => ['image', 'ar_pdf', 'en_pdf'],
        'brochures'             => ['image', 'pdf_file'],
        'pw_mena_publications'  => ['file_en', 'file_ar', 'file_fr'],
        'blogs'                 => ['image'],
        'news'                  => ['image'],
        'events'                => ['image'],
        'communities'           => ['image', 'thumbnail_image'],
        'partners'              => ['logo'],
        'gender_ais'            => ['thumbnail_image'],
        'aswats'                => ['thumbnail_image'],
        'featured_posts'        => ['image'],
        'featured_initiative_cards' => ['image'],
        'new_work_blogs'        => ['image'],
        'seo'                   => ['image'],
        'static_content'        => ['media', 'image'],
    ];

    public function handle(): int
    {
        $base   = rtrim($this->option('source'), '/');
        $dryRun = (bool) $this->option('dry-run');
        $only   = $this->option('only')
            ? array_map('trim', explode(',', $this->option('only')))
            : null;

        if ($this->option('fix-prefixes')) {
            return $this->fixPrefixes($only);
        }

        $disk = Storage::disk('public');

        $checked = 0;
        $present = 0;
        $missing = [];      // path => true (deduped)

        foreach ($this->map as $table => $columns) {
            if ($only && !in_array($table, $only, true)) {
                continue;
            }
            if (!Schema::hasTable($table)) {
                $this->warn("skip: table '{$table}' does not exist");
                continue;
            }
            $columns = array_values(array_filter($columns, fn ($c) => Schema::hasColumn($table, $c)));
            if (!$columns) {
                continue;
            }

            foreach (DB::table($table)->select(array_merge(['id'], $columns))->cursor() as $row) {
                foreach ($columns as $col) {
                    $path = $this->normalize($row->$col ?? null);
                    if ($path === null) {
                        continue;
                    }
                    $checked++;
                    if ($disk->exists($path)) {
                        $present++;
                    } else {
                        $missing[$path] = "{$table}#{$row->id}.{$col}";
                    }
                }
            }
        }

        $this->info("Checked: {$checked} path(s)  |  Present: {$present}  |  Missing: " . count($missing));

        if (!$missing) {
            $this->info('Nothing missing. Everything referenced in the DB is present on disk.');
            return self::SUCCESS;
        }

        $restored = 0;
        $failed   = [];

        foreach ($missing as $path => $origin) {
            if ($dryRun) {
                $this->line("  MISSING  {$path}   ({$origin})");
                continue;
            }

            $url = $base . '/' . ltrim($path, '/');
            try {
                $res = Http::withOptions(['verify' => false, 'allow_redirects' => true])
                    ->timeout(60)
                    ->get($url);
            } catch (\Throwable $e) {
                $failed[$path] = $e->getMessage();
                $this->error("  FAIL  {$path}  ({$e->getMessage()})");
                continue;
            }

            if ($res->successful() && strlen($res->body()) > 0) {
                $disk->put($path, $res->body());
                $restored++;
                $this->line("  OK    {$path}  (" . strlen($res->body()) . " bytes)");
            } else {
                $failed[$path] = 'HTTP ' . $res->status();
                $this->error("  FAIL  {$path}  (HTTP {$res->status()}, {$origin})");
            }
        }

        if ($dryRun) {
            $this->info('Dry run complete. Re-run without --dry-run to download.');
            return self::SUCCESS;
        }

        $this->info("Restored: {$restored}  |  Still failing: " . count($failed));
        if ($failed) {
            $this->warn('These could not be recovered (genuinely lost — re-upload via admin):');
            foreach ($failed as $path => $why) {
                $this->line("  - {$path}  ({$why})  [{$missing[$path]}]");
            }
        }

        return self::SUCCESS;
    }

    /**
     * Strip a leading "storage/" from every mapped column. Stored paths should
     * be disk-relative (e.g. "abc.jpg"); a "storage/" prefix makes Storage::url
     * produce "/storage/storage/abc.jpg" which 404s.
     */
    private function fixPrefixes(?array $only): int
    {
        $totalRows = 0;

        foreach ($this->map as $table => $columns) {
            if ($only && !in_array($table, $only, true)) {
                continue;
            }
            if (!Schema::hasTable($table)) {
                continue;
            }
            foreach ($columns as $col) {
                if (!Schema::hasColumn($table, $col)) {
                    continue;
                }
                $rows = DB::table($table)
                    ->where($col, 'like', 'storage/%')
                    ->update([$col => DB::raw('SUBSTRING(' . $col . ', 9)')]);

                if ($rows > 0) {
                    $totalRows += $rows;
                    $this->line("  {$table}.{$col}: stripped 'storage/' from {$rows} row(s)");
                }
            }
        }

        $this->info($totalRows > 0
            ? "Done. Removed the 'storage/' prefix from {$totalRows} value(s)."
            : "No values had a leading 'storage/' prefix.");

        return self::SUCCESS;
    }

    /**
     * Return a clean public-disk-relative path, or null if this value is not a
     * locally-stored file (empty, external URL, or a public/ root path).
     */
    private function normalize(?string $value): ?string
    {
        $value = trim((string) $value);
        if ($value === '') {
            return null;
        }
        // External URLs (YouTube thumbs, off-site PDFs) — not our files.
        if (Str::startsWith($value, ['http://', 'https://'])) {
            return null;
        }
        // Absolute public/ paths (e.g. "/docs/x.pdf") live outside the disk.
        if (Str::startsWith($value, '/')) {
            return null;
        }
        // Tolerate a stray "storage/" prefix that may remain on a few rows.
        if (Str::startsWith($value, 'storage/')) {
            $value = substr($value, 8);
        }
        return $value;
    }
}
