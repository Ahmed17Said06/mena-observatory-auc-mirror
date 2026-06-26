<?php

namespace Database\Seeders;

use App\Models\FeaturedInitiativeCard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Populate the home-page "Featured" initiative cards with real logos where a
 * brand asset is available. The images are bundled under
 * database/seeders/assets/featured/ and copied onto the public disk.
 *
 * Idempotent & non-destructive: only fills cards whose `image` is still null,
 * so a manually uploaded image is never overwritten. Cards without a usable
 * brand asset (RAI Cup, Future of Work, Brochures) are left for a manual
 * upload via the Filament resource.
 */
class FetchFeaturedCardImagesSeeder extends Seeder
{
    public function run(): void
    {
        // card lookup key (link) => bundled asset filename
        $map = [
            'https://iyab.io/'      => 'iyab.png',             // IYAB
            'https://i-raise.org/'  => 'safe-ai-children.png', // Safe AI for Children
            'ai_indices'            => 'girai.png',            // Global Index on Responsible AI
        ];

        $assetDir = database_path('seeders/assets/featured');

        foreach ($map as $link => $file) {
            $card = FeaturedInitiativeCard::where('link', $link)->first();
            if (! $card || $card->image) {
                continue; // missing card, or already has an image — leave it
            }

            $source = $assetDir . DIRECTORY_SEPARATOR . $file;
            if (! is_file($source)) {
                $this->command?->warn("Featured image asset not found: {$source}");
                continue;
            }

            $dest = 'featured/' . $file;
            Storage::disk('public')->put($dest, file_get_contents($source));

            $card->image = $dest;
            $card->save();

            $this->command?->info("Set image for featured card '{$card->title_en}' → {$dest}");
        }
    }
}
