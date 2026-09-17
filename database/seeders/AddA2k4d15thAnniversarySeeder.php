<?php

namespace Database\Seeders;

use App\Models\Aswat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Adds the A2K4D 15th Anniversary film to the Aswat tab and installs its
 * thumbnail (the film's closing card, committed under seeders/assets/aswat)
 * onto the public disk. Keyed on the Drive link so re-running is idempotent.
 * The Drive file link plays inline via the model's embed_url (/preview).
 *
 *     php artisan db:seed --class=Database\Seeders\AddA2k4d15thAnniversarySeeder --force
 */
class AddA2k4d15thAnniversarySeeder extends Seeder
{
    public function run(): void
    {
        $link = 'https://drive.google.com/file/d/1175frokrR2m_5hC-oBsVXK0jeloyWHMN/view';

        // Install the committed thumbnail onto the public disk.
        $thumbRel = 'aswat_thumbs/a2k4d-15th-anniversary.jpg';
        $src = database_path('seeders/assets/aswat/a2k4d-15th-anniversary.jpg');
        if (is_file($src)) {
            Storage::disk('public')->makeDirectory('aswat_thumbs');
            Storage::disk('public')->put($thumbRel, file_get_contents($src));
        }

        Aswat::updateOrCreate(
            ['link' => $link],
            [
                'title'           => 'A2K4D 15th Anniversary – 15 Years of Pushing Boundaries',
                'description'     => 'Celebrating 15 years of the Access to Knowledge for Development Center (A2K4D) at AUC — from humble beginnings to a leading research institution shaping conversations on technology, data and AI in the region.',
                'thumbnail_image' => is_file($src) ? $thumbRel : '',
            ]
        );

        $this->command->info('A2K4D 15th Anniversary film added to Aswat with thumbnail.');
    }
}
