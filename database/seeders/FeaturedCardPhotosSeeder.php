<?php

namespace Database\Seeders;

use App\Models\FeaturedInitiativeCard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Gives every home-page "Featured" card an image taken from the thing it
 * links to, replacing the logos and the placeholder graphic. Images are
 * bundled under database/seeders/assets/featured/ and copied onto the public
 * disk. Keyed on the card link; re-running is idempotent.
 *
 * Unlike FetchFeaturedCardImagesSeeder this does overwrite the card's image:
 * replacing the old ones is its purpose.
 *
 *     php artisan db:seed --class=Database\Seeders\FeaturedCardPhotosSeeder --force
 */
class FeaturedCardPhotosSeeder extends Seeder
{
    /** @var array<string, string> card link => bundled image (and where it comes from) */
    private array $images = [
        'news.iairn-cohort'    => 'iairn-cohort-teams.jpg',     // the cohort section of the IAIRN page
        'https://i-raise.org/' => 'safe-ai-children-site.jpg',  // i-raise.org hero image
        'news.rai-cup'         => 'rai-cup-ceremony.jpg',       // still from the ceremony video
        'ai_indices'           => 'girai-map.jpg',              // the AI Indices page map
        'pw_mena'              => 'future-of-work-reports.jpg', // covers of two New Work reports
        'brochures.index'      => 'brochures-cover.jpg',        // the brochure's cover
        'https://iyab.io/'     => 'iyab-site.jpg',              // iyab.io hero illustration
    ];

    public function run(): void
    {
        $disk = Storage::disk('public');
        $disk->makeDirectory('featured');

        foreach ($this->images as $link => $file) {
            $card = FeaturedInitiativeCard::where('link', $link)->first();
            if (!$card) {
                $this->command->warn("  No featured card links to {$link}, skipped.");
                continue;
            }

            $rel = 'featured/' . $file;
            $src = database_path('seeders/assets/featured/' . $file);
            if (!is_file($src) || !$disk->put($rel, file_get_contents($src))) {
                // The public disk swallows write failures (no 'throw'), so
                // surface them: usually a permissions issue when artisan is
                // not run as the web user.
                $this->command->error("  Could not write {$disk->path($rel)} — run as the web user (e.g. sudo -u www-data).");
                continue;
            }

            $card->image = $rel;
            $card->save();
            $this->command->info('  ' . $card->title_en);
        }
    }
}
