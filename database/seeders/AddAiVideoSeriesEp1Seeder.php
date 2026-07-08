<?php

namespace Database\Seeders;

use App\Models\Aswat;
use Illuminate\Database\Seeder;

/**
 * Adds Episode 1 of the AI Video Series to the Aswat tab. Keyed on the Drive
 * link so re-running is idempotent (won't create duplicates). The Drive file
 * link plays inline via the model's embed_url (/preview); a real thumbnail can
 * be generated afterwards with `php artisan aswat:extract-thumbs`.
 *
 *     php artisan db:seed --class=Database\\Seeders\\AddAiVideoSeriesEp1Seeder --force
 */
class AddAiVideoSeriesEp1Seeder extends Seeder
{
    public function run(): void
    {
        $link = 'https://drive.google.com/file/d/1YfBe_ihgsipOTjypmgakLNpKjGOxgVyd/view';

        Aswat::firstOrCreate(
            ['link' => $link],
            [
                'title'           => 'AI Video Series – Episode 1',
                'description'     => 'The first episode of our AI Video Series.',
                'thumbnail_image' => '',
            ]
        );

        $this->command->info('AI Video Series – Episode 1 added to Aswat.');
    }
}
