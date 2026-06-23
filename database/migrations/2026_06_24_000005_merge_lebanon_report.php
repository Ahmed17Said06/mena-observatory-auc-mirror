<?php

use App\Models\PwMenaPublication;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

/**
 * Consolidate the two Lebanon reports into one: move the clean /docs EN+AR
 * links from "New Work: Platform Workers - Case of Lebanon" onto the canonical
 * "The perils of digital work in Lebanon…" entry (clearing its messy uploaded
 * files so the clean links are used), then delete the duplicate.
 * Guarded by title; no-op if either row is absent.
 */
return new class extends Migration
{
    public function up(): void
    {
        $dst = PwMenaPublication::where('type', 'report')
            ->whereRaw('LOWER(title) LIKE ?', ['%perils of digital work in lebanon%'])
            ->first();
        $src = PwMenaPublication::where('title', 'New Work: Platform Workers - Case of Lebanon')->first();

        if (! $dst || ! $src) {
            return;
        }

        if ($src->link_en) {
            $dst->link_en = $src->link_en;
            $dst->file_en = null;   // drop the messy upload so the clean /docs link wins
        }
        if ($src->link_ar) {
            $dst->link_ar = $src->link_ar;
            $dst->file_ar = null;
        }
        $dst->save();

        $src->delete();
    }

    public function down(): void
    {
        // Non-reversible consolidation.
    }
};
