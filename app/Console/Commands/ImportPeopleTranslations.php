<?php

namespace App\Console\Commands;

use App\Models\Community;
use Illuminate\Console\Command;

/**
 * Updates People (communities) bios from the "Name and Bios Translation" sheet
 * (committed as seeders/assets/people_translations.json):
 *
 *   - English short/long bios are refreshed for everyone already on the site
 *     (the sheet is the source of truth — people edited their text and some PII
 *     was removed).
 *   - Arabic name + bios are published ONLY for rows whose Consent box is TRUE.
 *     Unapproved rows leave the Arabic columns null, so the AR site falls back
 *     to English.
 *
 * Matches by English name (trimmed, case-insensitive). Names that don't match
 * an existing person are SKIPPED and reported — nothing is created. Idempotent.
 *
 *     php artisan people:import-bios            # dry run (default) — report only
 *     php artisan people:import-bios --apply    # write the changes
 */
class ImportPeopleTranslations extends Command
{
    protected $signature = 'people:import-bios {--apply : Persist the changes (otherwise dry-run)}';
    protected $description = 'Update People EN bios and publish approved AR name/bio translations from the sheet';

    public function handle(): int
    {
        $apply = (bool) $this->option('apply');

        $path = database_path('seeders/assets/people_translations.json');
        if (! is_file($path)) {
            $this->error("Missing {$path}");
            return self::FAILURE;
        }

        $rows = json_decode(file_get_contents($path), true) ?: [];

        $updated = 0;
        $translated = 0;
        $skipped = [];
        $skippedApproved = [];

        foreach ($rows as $r) {
            $name = trim($r['name'] ?? '');
            if ($name === '') {
                continue;
            }
            $approved = (bool) ($r['approved'] ?? false);

            $c = Community::whereRaw('LOWER(TRIM(name)) = ?', [mb_strtolower($name)])->first();

            if (! $c) {
                $skipped[] = $name;
                if ($approved) {
                    $skippedApproved[] = $name;
                }
                continue;
            }

            // English bios — sheet is source of truth (PII removed). Only write
            // non-empty values so a blank cell never wipes an existing bio.
            $shortEn = trim($r['short_en'] ?? '');
            $longEn  = trim($r['long_en'] ?? '');
            if ($shortEn !== '') $c->description = $shortEn;
            if ($longEn  !== '') $c->content     = $longEn;

            // Arabic — only for approved rows.
            $didTranslate = false;
            if ($approved) {
                $nameAr  = trim($r['name_ar'] ?? '');
                $shortAr = trim($r['short_ar'] ?? '');
                $longAr  = trim($r['long_ar'] ?? '');
                if ($nameAr  !== '') $c->name_ar        = $nameAr;
                if ($shortAr !== '') $c->description_ar = $shortAr;
                if ($longAr  !== '') $c->content_ar     = $longAr;
                $didTranslate = ($nameAr !== '' || $shortAr !== '' || $longAr !== '');
            }

            if ($apply) {
                $c->save();
            }

            $updated++;
            if ($didTranslate) {
                $translated++;
            }
            $this->line(sprintf('  %s #%-4d %s%s',
                $apply ? 'updated' : 'would update',
                $c->id,
                $name,
                $didTranslate ? '  [+AR]' : ''));
        }

        $this->newLine();
        $this->info(($apply ? 'Applied. ' : '[dry-run] ')
            . "Matched/updated: {$updated}  |  Arabic published: {$translated}  |  Skipped (not found): " . count($skipped));

        if ($skipped) {
            $this->newLine();
            $this->warn('Not found on the site (skipped — send correct spellings / new entries to add):');
            foreach ($skipped as $n) {
                $this->line('   - ' . $n . (in_array($n, $skippedApproved, true) ? '  << APPROVED translation NOT applied' : ''));
            }
        }

        if (! $apply) {
            $this->newLine();
            $this->comment('Dry run only. Re-run with --apply to write these changes.');
        }

        return self::SUCCESS;
    }
}
