<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Ensure the Regional & Global resource filters always offer the canonical
 * resource types: Blogpost, Report, Policy. ("All" is the default <option>
 * already rendered by the repo-list filter selector.)
 *
 * Idempotent: only inserts a type if it doesn't already exist by name.
 */
return new class extends Migration
{
    public function up(): void
    {
        foreach (['Blogpost', 'Report', 'Policy'] as $name) {
            if (! DB::table('repo_type')->where('name', $name)->exists()) {
                DB::table('repo_type')->insert([
                    'name'       => $name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        // Non-destructive on purpose: leave the canonical types in place.
    }
};
