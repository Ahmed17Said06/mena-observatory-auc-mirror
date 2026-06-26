<?php

use App\Models\Events;
use Illuminate\Database\Migrations\Migration;

/**
 * One-time data cleanup: remove the obsolete "Adsero Law Firm × A2K4D Event".
 * Idempotent and safe on any DB — a no-op where the row doesn't exist.
 */
return new class extends Migration
{
    public function up(): void
    {
        Events::where('title', 'like', '%Adsero%')->delete();
    }

    public function down(): void
    {
        // No-op: deleted event is not restored.
    }
};
