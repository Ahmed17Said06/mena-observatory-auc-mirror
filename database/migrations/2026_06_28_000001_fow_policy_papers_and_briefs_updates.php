<?php

use App\Models\PwMenaPublication;
use Illuminate\Database\Migrations\Migration;

/**
 * Future of Work content corrections requested by the client.
 *
 * Policy Papers (reports):
 *   1. "Platform work, social protection and representation: a case of delivery
 *      workers in Egypt"  ->  "Social Security Provisions for Workers in the
 *      Platform Economy: Policy Options with Focus on Egypt"
 *   2. Reaction Note on the Draft Labor Law: replace the .docx with the new PDF.
 *   3. "New Work: Platform Workers in Egypt 2025"  ->  "Platform Work, Social
 *      Protection, and Representation: a Case of Delivery Workers in Egypt"
 *
 * Policy Briefs:
 *   1. "Improving Inclusivity in the Platform Economy"  ->  "Improving
 *      Inclusivity in Tunisia's Platform Economy: a Policy Brief"
 *   2. Morocco brief: attach the Arabic policy brief PDF.
 *
 * Matched by title needle + type so it no-ops on a DB whose rows differ.
 * Note: paper #1 and #3 are a deliberate title hand-off — #1 vacates the
 * "delivery workers in Egypt" title and #3 takes it. Order matters; #1 runs
 * first.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Papers #1 — rename (frees up the "delivery workers in Egypt" title).
        $this->retitle('report', 'platform work, social protection and representation',
            'Social Security Provisions for Workers in the Platform Economy: Policy Options with Focus on Egypt');

        // Papers #3 — takes the vacated title.
        $this->retitle('report', 'new work: platform workers in egypt 2025',
            'Platform Work, Social Protection, and Representation: a Case of Delivery Workers in Egypt');

        // Papers #2 — reaction note: point to the PDF instead of the .docx.
        $rn = $this->find('report', 'reaction note on the draft labor law');
        if ($rn) {
            $rn->file_en = null;
            $rn->link_en = '/docs/egypt/reaction-note-draft-labor-law.pdf';
            $rn->save();
        }

        // Briefs #1 — Tunisia inclusivity brief title.
        $this->retitle('brief', 'improving inclusivity in the platform economy',
            "Improving Inclusivity in Tunisia's Platform Economy: a Policy Brief");

        // Briefs #2 — Morocco brief: attach the Arabic PDF.
        $mor = $this->find('brief', 'platform workers in morocco');
        if ($mor) {
            $mor->file_ar = null;
            $mor->link_ar = '/docs/morocco/morocco-platform-workers-policy-brief-ar.pdf';
            $mor->save();
        }
    }

    public function down(): void
    {
        // Non-reversible content correction.
    }

    private function find(string $type, string $needle): ?PwMenaPublication
    {
        return PwMenaPublication::where('type', $type)
            ->whereRaw('LOWER(title) LIKE ?', ['%' . $needle . '%'])
            ->first();
    }

    private function retitle(string $type, string $needle, string $newTitle): void
    {
        $row = $this->find($type, $needle);
        if ($row) {
            $row->title = $newTitle;
            $row->save();
        }
    }
};
