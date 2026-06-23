<?php

use App\Models\PwMenaPublication;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

/**
 * One-time cleanup of the Future-of-Work (pw_mena_publications) reports &
 * briefs: consolidate per-language duplicate rows into single entries, fix the
 * "Policy Brief: Case of XX" titles, and remove the wrong-title / duplicate
 * rows. Every action is guarded by id + a title check so it only runs against
 * the intended production rows and is a no-op elsewhere.
 *
 * Empty placeholder rows (papers awaiting a PDF) are intentionally left in
 * place — they are now hidden on the frontend by PwMenaPublication::hasOutput().
 */
return new class extends Migration
{
    public function up(): void
    {
        // ── REPORTS ──────────────────────────────────────────────────────────

        // Lebanon: keep #2 (correct title, EN+AR), normalise its title.
        $leb = PwMenaPublication::find(2);
        if ($leb && Str::contains(Str::lower($leb->title), 'perils')) {
            $leb->title = 'The perils of digital work in Lebanon: Lessons from taxi and delivery workers';
            $leb->save();
        }
        // Delete the AR-only duplicate (#3) and the wrong-title row (#10).
        $this->deleteIf(3, 'perils');
        $this->deleteIf(10, 'case of lebanon');

        // Morocco: merge #5's Arabic onto #4, then delete #5.
        $mar  = PwMenaPublication::find(4);
        $mar5 = PwMenaPublication::find(5);
        if ($mar && Str::contains(Str::lower($mar->title), 'morocco case study')) {
            if ($mar5 && empty($mar->file_ar) && empty($mar->link_ar)) {
                $mar->file_ar = $mar5->file_ar;
                $mar->link_ar = $mar5->link_ar;
            }
            $mar->title = 'Platform Workers: A Morocco Case Study';
            $mar->save();
        }
        $this->deleteIf(5, 'morocco case study');

        // ── BRIEFS ───────────────────────────────────────────────────────────

        // Lebanon: move #20's EN+AR onto the correct empty title #19, delete #20.
        $leb19 = PwMenaPublication::find(19);
        $leb20 = PwMenaPublication::find(20);
        if ($leb19 && $leb20
            && Str::contains(Str::lower($leb19->title), 'precarious freelancing')
            && Str::contains(Str::lower($leb20->title), 'case of lebanon')) {
            $leb19->link_en  = $leb19->link_en ?: $leb20->link_en;
            $leb19->file_en  = $leb19->file_en ?: $leb20->file_en;
            $leb19->link_ar  = $leb19->link_ar ?: $leb20->link_ar;
            $leb19->file_ar  = $leb19->file_ar ?: $leb20->file_ar;
            $leb19->ar_title = $leb19->ar_title ?: $leb20->ar_title;
            $leb19->save();
            $leb20->delete();
        }

        // Egypt & Tunisia briefs: drop the "Policy Brief: Case of XX" wording.
        $this->renameIf(23, 'case of egypt', 'Platform Workers in Egypt: a Policy Brief');
        $this->renameIf(24, 'case of tunisia', 'Platform Workers in Tunisia: a Policy Brief');
    }

    public function down(): void
    {
        // Non-reversible data cleanup; deleted rows are not restored.
    }

    private function deleteIf(int $id, string $titleNeedle): void
    {
        $row = PwMenaPublication::find($id);
        if ($row && Str::contains(Str::lower($row->title), $titleNeedle)) {
            $row->delete();
        }
    }

    private function renameIf(int $id, string $titleNeedle, string $newTitle): void
    {
        $row = PwMenaPublication::find($id);
        if ($row && Str::contains(Str::lower($row->title), $titleNeedle)) {
            $row->title = $newTitle;
            $row->save();
        }
    }
};
