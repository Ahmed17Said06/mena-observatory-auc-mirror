<?php

namespace Database\Seeders;

use App\Models\Aswat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Adds Episode 1 of the AI Video Series to the Aswat tab and installs its
 * branded thumbnail (committed under seeders/assets/aswat) onto the public
 * disk. Keyed on the Drive link so re-running is idempotent. The Drive file
 * link plays inline via the model's embed_url (/preview).
 *
 *     php artisan db:seed --class=Database\\Seeders\\AddAiVideoSeriesEp1Seeder --force
 */
class AddAiVideoSeriesEp1Seeder extends Seeder
{
    public function run(): void
    {
        $link = 'https://drive.google.com/file/d/1YfBe_ihgsipOTjypmgakLNpKjGOxgVyd/view';

        // Install the committed thumbnail onto the public disk.
        $thumbRel = 'aswat_thumbs/ai-video-series-ep1.jpg';
        $src = database_path('seeders/assets/aswat/ai-video-series-ep1.jpg');
        if (is_file($src)) {
            Storage::disk('public')->makeDirectory('aswat_thumbs');
            Storage::disk('public')->put($thumbRel, file_get_contents($src));
        }

        Aswat::updateOrCreate(
            ['link' => $link],
            [
                'title'           => 'AI Video Series – Episode 1',
                'description'     => 'The first episode of our AI Video Series.',
                'thumbnail_image' => is_file($src) ? $thumbRel : '',
            ]
        );

        $this->command->info('AI Video Series – Episode 1 added to Aswat with thumbnail.');
    }
}
