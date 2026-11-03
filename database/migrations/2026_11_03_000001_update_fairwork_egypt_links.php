<?php

use App\Models\PwMenaPublication;
use Illuminate\Database\Migrations\Migration;

/**
 * Fairwork moved its site from fair.work to fairwork.oii.ox.ac.uk, so the
 * links set in 2026_06_24_000008 now 404. Point the two Fairwork Egypt
 * reports at the new site (English) and at the Arabic copies the team shared
 * on Google Drive (the new site has no Arabic pages), and give the 2022/23
 * report (#14) its full title:
 *   - Fairwork Egypt 2021 (#12) → Fairwork page (EN) + Drive (AR)
 *   - Fairwork Egypt Ratings 2022/23 (#14) → Fairwork PDF (EN) + Drive (AR)
 * Guarded by title; no-op if a row is absent.
 */
return new class extends Migration
{
    public function up(): void
    {
        $this->update('fairwork egypt 2021', [
            'link_en' => 'https://fairwork.oii.ox.ac.uk/en/fw/publications/fairwork-egypt-ratings-2021-towards-decent-work-in-a-highly-informal-economy/',
            'link_ar' => 'https://drive.google.com/file/d/1ZBY2PosgZLaJswyGAXugpFnvNHIjiqcA/view',
        ]);

        $this->update('fairwork egypt 2022', [
            'title'   => 'Fairwork (2023) Fairwork Egypt Ratings 2022/23: Platform Workers Amidst Egypt’s Economic Crisis',
            'link_en' => 'https://fairwork.oii.ox.ac.uk/wp-content/uploads/sites/11/2023/03/Fairwork-Egypt-Report-2022-23.pdf',
            'link_ar' => 'https://drive.google.com/file/d/1lS40P-2m2vX4Bf_DKTHBseMwVbcnGHqb/view',
        ]);
    }

    public function down(): void
    {
        // Non-reversible link change.
    }

    private function update(string $titleNeedle, array $values): void
    {
        $row = PwMenaPublication::where('type', 'report')
            ->whereRaw('LOWER(title) LIKE ?', ['%' . $titleNeedle . '%'])
            ->first();
        if (! $row) {
            return;
        }
        foreach ($values as $col => $val) {
            $row->$col = $val;
        }
        $row->save();
    }
};
