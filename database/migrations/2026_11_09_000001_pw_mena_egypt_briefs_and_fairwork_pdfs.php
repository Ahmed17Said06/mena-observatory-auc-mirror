<?php

use App\Models\PwMenaPublication;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Platform Workers page corrections from the A2K4D team (November 2026).
 *
 * Policy briefs: the two Egypt briefs had their PDFs crossed.
 * egypt-delivery-workers-policy-brief.pdf is Ghada Barsoum's "Social Security
 * Provisions" brief; egypt-platform-workers-policy-brief-{en,ar}.pdf are Nagla
 * Rizk's "Social protection and representation" brief.
 *   - Rizk brief    → EN + AR egypt-platform-workers-policy-brief-*.pdf
 *   - Barsoum brief → EN egypt-delivery-workers-policy-brief.pdf, no Arabic
 *
 * Fairwork reports: serve the PDFs from this site (English from Fairwork,
 * Arabic from the team), use the reports' own citation titles, and list the
 * authors.
 *   - 2021    → docs/egypt/fairwork-egypt-2021-{en,ar}.pdf
 *   - 2022/23 → docs/egypt/fairwork-egypt-2022-23-{en,ar}.pdf
 *
 * Research repository: the two Fairwork Egypt entries still link to fair.work,
 * which now 404s; point them at the same pages on fairwork.oii.ox.ac.uk.
 *
 * Rows are matched by title, so this no-ops where they differ and is safe to
 * re-run.
 */
return new class extends Migration
{
    private const PLACE = 'Cairo, Egypt; Oxford, United Kingdom.';

    public function up(): void
    {
        $this->update($this->find('brief', 'social protection and representation for delivery workers%'), [
            'link_en'       => '/docs/egypt/egypt-platform-workers-policy-brief-en.pdf',
            'link_ar'       => '/docs/egypt/egypt-platform-workers-policy-brief-ar.pdf',
            'file_en'       => null,
            'file_ar'       => null,
            'external_link' => null,
        ]);

        $this->update($this->find('brief', 'social security provisions for workers in the platform economy%'), [
            'link_en'       => '/docs/egypt/egypt-delivery-workers-policy-brief.pdf',
            'link_ar'       => null,
            'file_en'       => null,
            'file_ar'       => null,
            'external_link' => null,
        ]);

        $this->update($this->find('report', '%fairwork%2021%', '%2022%'), [
            'title'       => 'Fairwork (2021) Fairwork Egypt Ratings 2021: Labour Standards in the Gig Economy',
            'description' => 'Authors: Nagla Rizk, Nagham ElHoussamy, Nadine Weheba, Khadiga Hassan, Haya El Zayat, and Adel Osama. ' . self::PLACE,
            'link_en'     => '/docs/egypt/fairwork-egypt-2021-en.pdf',
            'link_ar'     => '/docs/egypt/fairwork-egypt-2021-ar.pdf',
            'file_en'     => null,
            'file_ar'     => null,
        ]);

        $this->update($this->find('report', '%fairwork%2022/23%'), [
            'title'       => 'Fairwork (2023) Fairwork Egypt Ratings 2022/23: Platform Workers Amidst Egypt’s Economic Crisis',
            'description' => 'Authors: Nagla Rizk, Batoul AlMehdar, Khadiga Hassan, Eisha Afifi, Farah Galal, and Dana ElBashbishy. ' . self::PLACE,
            'link_en'     => '/docs/egypt/fairwork-egypt-2022-23-en.pdf',
            'link_ar'     => '/docs/egypt/fairwork-egypt-2022-23-ar.pdf',
            'file_en'     => null,
            'file_ar'     => null,
        ]);

        foreach ([
            'fairwork-egypt-ratings-2021-towards-decent-work-in-a-highly-informal-economy',
            'fairwork-egypt-ratings-2022-23-platform-workers-amidst-egypts-economic-crisis',
        ] as $slug) {
            DB::table('repo')
                ->where('data_link', 'like', 'https://fair.work/en/fw/publications/' . $slug . '%')
                ->update(['data_link' => 'https://fairwork.oii.ox.ac.uk/en/fw/publications/' . $slug . '/']);
        }
    }

    public function down(): void
    {
        // Non-reversible content correction.
    }

    private function find(string $type, string $like, ?string $notLike = null): ?PwMenaPublication
    {
        $q = PwMenaPublication::where('type', $type)->whereRaw('LOWER(title) LIKE ?', [$like]);
        if ($notLike) {
            $q->whereRaw('LOWER(title) NOT LIKE ?', [$notLike]);
        }
        return $q->first();
    }

    private function update(?PwMenaPublication $row, array $values): void
    {
        if ($row) {
            $row->forceFill($values)->save();
        }
    }
};
