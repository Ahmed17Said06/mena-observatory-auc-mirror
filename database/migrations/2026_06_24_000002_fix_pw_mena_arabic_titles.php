<?php

use App\Models\PwMenaPublication;
use Illuminate\Database\Migrations\Migration;

/**
 * Follow-up to the pw_mena cleanup: fix the Arabic titles that still carried the
 * "موجز سياسات – … – حالة XX" ("Policy Brief: Case of XX") wording so they match
 * the corrected English titles, and de-tatweel the Morocco report's ar_title.
 * Guarded by id; no-op if a row is missing.
 */
return new class extends Migration
{
    public function up(): void
    {
        $titles = [
            // Morocco report — remove the letter-spacing (tatweel).
            4  => 'عمال المنصات الرقمية: دراسة حالة مغربية',
            // Lebanon brief — match "Precarious freelancing: Lebanon's grim future of work".
            19 => 'العمل الحر غير المستقر: مستقبل العمل القاتم في لبنان',
            // Egypt / Tunisia briefs — parallel to the renamed English titles.
            23 => 'عمال المنصات الرقمية في مصر: موجز سياسات',
            24 => 'عمال المنصات الرقمية في تونس: موجز سياسات',
        ];

        foreach ($titles as $id => $arTitle) {
            $row = PwMenaPublication::find($id);
            if ($row) {
                $row->ar_title = $arTitle;
                $row->save();
            }
        }
    }

    public function down(): void
    {
        // Non-reversible title cleanup.
    }
};
