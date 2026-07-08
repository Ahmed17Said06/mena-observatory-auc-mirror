<?php

use App\Models\Events;
use Illuminate\Database\Migrations\Migration;

/**
 * One-time data cleanup: collapse the duplicate "Al Khwarizmi AI Event — Cairo
 * Convening" rows (three identical entries surfaced by searching "Khwarizmi")
 * down to a single record.
 *
 * Keeps the most complete copy — prefers a row that has an end_date, then one
 * with an image, then the lowest id — and deletes the rest. Idempotent and
 * DB-agnostic: a no-op once only one Khwarizmi event remains, so it never
 * touches a DB whose data differs.
 */
return new class extends Migration
{
    public function up(): void
    {
        $events = Events::where('title', 'like', '%khwarizmi%')->get();

        if ($events->count() < 2) {
            return; // nothing to dedupe
        }

        $keeper = $events->sortBy(fn ($e) => [
            $e->end_date ? 0 : 1,          // prefer a row that has an end date
            ! empty($e->image) ? 0 : 1,    // then one that has an image
            $e->id,                        // stable tiebreak (lowest id)
        ])->first();

        Events::where('title', 'like', '%khwarizmi%')
            ->where('id', '!=', $keeper->id)
            ->delete();
    }

    public function down(): void
    {
        // No-op: removed duplicates are not restored.
    }
};
