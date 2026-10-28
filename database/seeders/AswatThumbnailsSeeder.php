<?php

namespace Database\Seeders;

use App\Models\Aswat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Replaces poor auto-picked thumbnails on standalone Aswat videos with a
 * hand-picked frame from the video itself (committed under
 * seeders/assets/aswat). Videos published by their own seeder (the AI Video
 * Series, Egypt AI Day) carry their thumbnails there instead. Keyed on the
 * video link; re-running is idempotent.
 *
 *     php artisan db:seed --class=Database\Seeders\AswatThumbnailsSeeder --force
 */
class AswatThumbnailsSeeder extends Seeder
{
    /** @var array<string, string> video link => thumbnail file */
    private array $thumbs = [
        // The auto pick landed on the AUC logo intro; this is the opening panel.
        'https://drive.google.com/file/d/14d21RGQGzUtcUq2wM7NZM9-442ZlV7kI/view' => 'rai-cup-awards-16-years-a2k4d.jpg',
    ];

    public function run(): void
    {
        $disk = Storage::disk('public');
        $disk->makeDirectory('aswat_thumbs');

        foreach ($this->thumbs as $link => $file) {
            $aswat = Aswat::where('link', $link)->first();
            if (!$aswat) {
                $this->command->warn("  No Aswat video for {$link}, skipped.");
                continue;
            }

            $thumbRel = 'aswat_thumbs/' . $file;
            $src = database_path('seeders/assets/aswat/' . $file);
            if (!is_file($src) || !$disk->put($thumbRel, file_get_contents($src))) {
                // The public disk swallows write failures (no 'throw'), so
                // surface them: usually a permissions issue when artisan is
                // not run as the web user.
                $this->command->error("  Could not write {$disk->path($thumbRel)} — run as the web user (e.g. sudo -u www-data).");
                continue;
            }

            $aswat->thumbnail_image = $thumbRel;
            $aswat->save();
            $this->command->info('  ' . $aswat->title);
        }
    }
}
