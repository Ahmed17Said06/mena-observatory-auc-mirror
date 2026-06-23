<?php

use App\Models\PwMenaPublication;
use Illuminate\Database\Migrations\Migration;

/**
 * Restore the Lebanon report row that the earlier cleanup deleted outright
 * (former #10, "New Work: Platform Workers - Case of Lebanon", EN+AR). The
 * underlying PDFs were never removed from disk; this re-creates the DB row
 * pointing at them. Idempotent: keyed on title.
 */
return new class extends Migration
{
    public function up(): void
    {
        $row = PwMenaPublication::firstOrNew([
            'title' => 'New Work: Platform Workers - Case of Lebanon',
        ]);
        $row->ar_title   = 'العمل الجديد - عمال المنصات الرقمية - حالة لبنان';
        $row->type       = 'report';
        $row->link_en    = '/docs/lebanon/lebanon-platform-workers-report-en.pdf';
        $row->link_ar    = '/docs/lebanon/lebanon-platform-workers-report-ar.pdf';
        $row->sort_order = 7;
        $row->save();
    }

    public function down(): void
    {
        PwMenaPublication::where('title', 'New Work: Platform Workers - Case of Lebanon')->delete();
    }
};
