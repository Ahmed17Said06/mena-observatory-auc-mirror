<?php

use App\Models\PwMenaPublication;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

/**
 * Wire up two reports to their (now-present) /docs files:
 *   - Cloudwork (#1): point EN at the freshly-committed /docs copy (its old
 *     publications/ upload was missing on disk).
 *   - Morocco report (#4): point EN/AR/FR at the clean /docs files already on
 *     disk — this adds the previously-unlinked French output — and drop the
 *     messy publications/ uploads.
 * Guarded by title; no-op if a row is absent.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Cloudwork — Egypt
        $cloud = PwMenaPublication::where('type', 'report')
            ->whereRaw('LOWER(title) LIKE ?', ['%cloudwork%'])
            ->first();
        if ($cloud) {
            $cloud->link_en = '/docs/egypt/cloudwork-egypt-2025-case-study-en.pdf';
            $cloud->file_en = null;
            $cloud->save();
        }

        // Morocco report — EN + AR + FR from the clean /docs files
        $mar = PwMenaPublication::where('type', 'report')
            ->whereRaw('LOWER(title) LIKE ?', ['%morocco case study%'])
            ->first();
        if ($mar) {
            $mar->link_en = '/docs/morocco/morocco-platform-workers-policy-paper-en.pdf';
            $mar->link_ar = '/docs/morocco/morocco-platform-workers-policy-paper-ar.pdf';
            $mar->link_fr = '/docs/morocco/morocco-platform-workers-policy-paper-fr.pdf';
            $mar->file_en = null;
            $mar->file_ar = null;
            $mar->save();
        }
    }

    public function down(): void
    {
        // Non-reversible link change.
    }
};
