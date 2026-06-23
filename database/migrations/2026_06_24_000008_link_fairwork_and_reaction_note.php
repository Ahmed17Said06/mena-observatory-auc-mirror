<?php

use App\Models\PwMenaPublication;
use Illuminate\Database\Migrations\Migration;

/**
 * Attach outputs to three previously-empty Future-of-Work reports:
 *   - Reaction Note on the Draft Labor Law (#8) → committed .docx
 *   - Fairwork Egypt 2021 (#12) → fair.work page (EN + AR)
 *   - Fairwork Egypt 2022/23 (#14) → fair.work page (EN + AR)
 * Guarded by title; no-op if a row is absent.
 */
return new class extends Migration
{
    public function up(): void
    {
        $this->setLinks('reaction note on the draft labor law', [
            'link_en' => '/docs/egypt/reaction-note-draft-labor-law.docx',
        ]);

        $this->setLinks('fairwork egypt 2021', [
            'link_en' => 'https://fair.work/en/fw/publications/fairwork-egypt-ratings-2021-towards-decent-work-in-a-highly-informal-economy/',
            'link_ar' => 'https://fair.work/ar/fw/publications/fairwork-egypt-ratings-2021-towards-decent-work-in-a-highly-informal-economy/',
        ]);

        $this->setLinks('fairwork egypt 2022', [
            'link_en' => 'https://fair.work/en/fw/publications/fairwork-egypt-ratings-2022-23-platform-workers-amidst-egypts-economic-crisis/',
            'link_ar' => 'https://fair.work/ar/fw/publications/fairwork-egypt-ratings-2022-23-platform-workers-amidst-egypts-economic-crisis/',
        ]);
    }

    public function down(): void
    {
        // Non-reversible link change.
    }

    private function setLinks(string $titleNeedle, array $links): void
    {
        $row = PwMenaPublication::where('type', 'report')
            ->whereRaw('LOWER(title) LIKE ?', ['%' . $titleNeedle . '%'])
            ->first();
        if (! $row) {
            return;
        }
        foreach ($links as $col => $val) {
            $row->$col = $val;
        }
        $row->save();
    }
};
