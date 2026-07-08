<?php

namespace Database\Seeders;

use App\Models\Brochure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Publishes the "A Multimedia Exhibition" brochure so it appears on the
 * /brochures page. The source PDF and a cover image (rendered from page 1) are
 * committed under seeders/assets/brochures and installed onto the public disk
 * here (same approach as AddAiVideoSeriesEp1Seeder). Keyed on slug, so
 * re-running is idempotent.
 *
 *     php artisan db:seed --class=Database\\Seeders\\PublishBrochureSeeder --force
 */
class PublishBrochureSeeder extends Seeder
{
    public function run(): void
    {
        $slug = 'a-multimedia-exhibition';
        $disk = Storage::disk('public');
        $disk->makeDirectory('brochures');

        $pdfSrc   = database_path("seeders/assets/brochures/{$slug}.pdf");
        $coverSrc = database_path("seeders/assets/brochures/{$slug}.jpg");
        $pdfRel   = "brochures/{$slug}.pdf";
        $coverRel = "brochures/{$slug}.jpg";

        if (is_file($pdfSrc))   $disk->put($pdfRel, file_get_contents($pdfSrc));
        if (is_file($coverSrc)) $disk->put($coverRel, file_get_contents($coverSrc));

        Brochure::updateOrCreate(
            ['slug' => $slug],
            [
                'title'        => 'A Multimedia Exhibition',
                'description'  => 'A multimedia exhibition brochure from the MENA Observatory on Responsible AI.',
                'image'        => is_file($coverSrc) ? $coverRel : null,
                'pdf_file'     => is_file($pdfSrc) ? $pdfRel : null,
                'is_published' => 1,
            ]
        );

        $this->command->info('Published brochure: A Multimedia Exhibition.');
    }
}
