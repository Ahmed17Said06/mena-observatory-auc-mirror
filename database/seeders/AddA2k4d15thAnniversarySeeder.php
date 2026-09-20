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
        $disk = Storage::disk('public');
        $written = false;
        if (is_file($src)) {
            $disk->makeDirectory('aswat_thumbs');
            $written = $disk->put($thumbRel, file_get_contents($src));
            if (!$written) {
                // The public disk swallows write failures (no 'throw'), so
                // surface them: usually a permissions issue when artisan is
                // not run as the web user.
                $this->command->error("Could not write {$disk->path($thumbRel)} — run as the web user (e.g. sudo -u www-data).");
            }
        }

        // Keep an existing thumbnail if this run couldn't write the file.
        $aswat = Aswat::firstOrNew(['link' => $link]);
        $aswat->title       = 'A2K4D 15th Anniversary – 15 Years of Pushing Boundaries';
        $aswat->description = 'Celebrating 15 years of the Access to Knowledge for Development Center (A2K4D) at AUC — from humble beginnings to a leading research institution shaping conversations on technology, data and AI in the region.';
        if ($written) {
            $aswat->thumbnail_image = $thumbRel;
        } elseif (!$aswat->exists) {
            $aswat->thumbnail_image = '';
        }
        $aswat->save();

        $this->command->info('A2K4D 15th Anniversary film added to Aswat' . ($written ? ' with thumbnail.' : ' (thumbnail NOT installed).'));
    }
}
