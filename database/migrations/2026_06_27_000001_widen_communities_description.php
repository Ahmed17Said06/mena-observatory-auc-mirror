<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Several imported People short bios exceed VARCHAR(255), which truncated the
 * `communities.description` column on insert. Widen it to TEXT (the list view
 * already clamps the short bio to a few lines).
 */
return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE `communities` MODIFY `description` TEXT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE `communities` MODIFY `description` VARCHAR(255) NOT NULL');
    }
};
