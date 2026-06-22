<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * The Global AI News section flags its curated external items with
 * news.featured = 'global_ai'. The original column is enum('no','yes'),
 * so that value was silently truncated. Widen the enum to include it.
 *
 * Idempotent: re-running just re-applies the same column definition.
 */
return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE `news` MODIFY `featured` ENUM('no','yes','global_ai') NOT NULL DEFAULT 'no'");
    }

    public function down(): void
    {
        // Reset any global_ai rows so the value fits the narrowed enum again.
        DB::table('news')->where('featured', 'global_ai')->update(['featured' => 'no']);
        DB::statement("ALTER TABLE `news` MODIFY `featured` ENUM('no','yes') NOT NULL DEFAULT 'no'");
    }
};
