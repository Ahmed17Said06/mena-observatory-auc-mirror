<?php

use App\Models\News;
use Illuminate\Database\Migrations\Migration;

/**
 * Fix the broken external link on the Global AI News item
 * "AI's environmental costs threaten water, land and climate".
 *
 * The stored data_link pointed at https://news.un.org/en/story/2025/07/1165306
 * which now returns 404; the correct live article (verified) is
 * https://news.un.org/en/story/2026/06/1167658.
 *
 * Guarded by title needle; a no-op if the row is absent.
 */
return new class extends Migration
{
    public function up(): void
    {
        News::where('title', 'like', '%environmental costs%')
            ->update(['data_link' => 'https://news.un.org/en/story/2026/06/1167658']);
    }

    public function down(): void
    {
        // No-op: content link correction.
    }
};
