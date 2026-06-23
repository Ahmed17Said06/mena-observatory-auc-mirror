<?php

use App\Models\PwMenaPublication;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

/**
 * Apply the client's canonical titles to the Future-of-Work publications and
 * fold the two extra briefs (#23 Egypt, #24 Tunisia) into their correct
 * existing-but-empty canonical rows (#17, #21), then delete the extras.
 *
 * The canonical set is 7 reports + 6 briefs. Guarded by id + title check so it
 * is a no-op on any DB whose rows differ.
 */
return new class extends Migration
{
    public function up(): void
    {
        // ── Report title corrections ─────────────────────────────────────────
        $reportTitles = [
            2  => 'The perils of digital work in Lebanon: lessons from taxi and delivery workers',
            4  => 'Platform Workers: a Morocco Case Study',
            9  => 'New Work, Data and Inclusion in the Digital Economy: A Middle East and North Africa Perspective Case Study Jordan',
            11 => "New Forms of Work, Old Forms of Exploitation: An Analysis of Tunisia's Platform and Informal Economies",
        ];
        foreach ($reportTitles as $id => $title) {
            $row = PwMenaPublication::find($id);
            if ($row && $row->type === 'report') {
                $row->title = $title;
                $row->save();
            }
        }

        // ── Fold extra briefs into their correct canonical (empty) rows ───────
        // #23 (Egypt platform-workers brief) → #17 (Social Security Provisions…Egypt)
        $this->foldBrief(23, 'egypt', 17, 'social security provisions for workers in the platform economy');
        // #24 (Tunisia brief) → #21 (Improving Inclusivity in the Platform Economy)
        $this->foldBrief(24, 'tunisia', 21, 'improving inclusivity in the platform economy');
    }

    public function down(): void
    {
        // Non-reversible data cleanup.
    }

    /**
     * Move every output column from the source brief onto the (empty) destination
     * brief, then delete the source. Guarded so it only fires on the intended rows.
     */
    private function foldBrief(int $srcId, string $srcNeedle, int $dstId, string $dstNeedle): void
    {
        $src = PwMenaPublication::find($srcId);
        $dst = PwMenaPublication::find($dstId);
        if (! $src || ! $dst) {
            return;
        }
        if (! Str::contains(Str::lower($src->title), $srcNeedle)
            || ! Str::contains(Str::lower($dst->title), $dstNeedle)) {
            return;
        }

        foreach (['link_en', 'file_en', 'link_ar', 'file_ar', 'link_fr', 'file_fr', 'external_link'] as $c) {
            if (empty($dst->$c) && ! empty($src->$c)) {
                $dst->$c = $src->$c;
            }
        }
        $dst->save();
        $src->delete();
    }
};
