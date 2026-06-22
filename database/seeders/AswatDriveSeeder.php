<?php

namespace Database\Seeders;

use App\Models\Aswat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

/**
 * Seeds the "aswat" (voices) home-page section with the AUC AI video set
 * hosted on Google Drive (folder "AUC AI VER3").
 *
 * Idempotent: keyed on the video link, so re-running updates rather than
 * duplicating. created_at is staggered (newest first) so the section, which
 * is ordered latest-first, shows these in the intended order.
 *
 * Links open the Drive player; thumbnails use Drive's generated image. The
 * Aswat::thumbnail_url accessor returns full URLs as-is. The Drive files must
 * be shared "anyone with the link" for the thumbnails to load.
 */
class AswatDriveSeeder extends Seeder
{
    public function run(): void
    {
        // Ordered as they should appear (first = shown first).
        $videos = [
            ['id' => '14d21RGQGzUtcUq2wM7NZM9-442ZlV7kI', 'title' => 'AUC AI Event'],
            ['id' => '1UF7oDNCLiAmijylvnxA6DABs4dQxw2b1', 'title' => 'Interview — Dr.'],
            ['id' => '10VEE0feIBpmyzH3GrYF-r4i5qf4SNLCw', 'title' => 'Interview One'],
            ['id' => '1ypBmAeqTvovL-pD3Tk_6JumQk-hUE0s3', 'title' => 'Interview Two'],
            ['id' => '1EPrlgzMvafXOFLtlaR6WxbomHQOzv9NC', 'title' => 'Interview Three'],
            ['id' => '1vGfNQHIOYBtfAL2f43WQbtJCGll2R-m3', 'title' => 'Interview Four'],
            ['id' => '18tFJvt0zspM_1RQuXng4L6tiEBupBoxp', 'title' => 'Interview Five'],
            ['id' => '1SutqtoHEyreUtU-yjUPD7W0Yu4OMIq_u', 'title' => 'Student 1'],
            ['id' => '1tekJs8CSmfofCZKPTAV6uxurc_2s-F99', 'title' => 'Student 2'],
            ['id' => '1b4nSHzrTizqzv9pJZVyPaY5gzCoCLgX-', 'title' => 'Student 3'],
            ['id' => '1F3-lPAjDORauR6twXSB5pWNSEuAsNyqF', 'title' => 'Student 4'],
        ];

        $base = Carbon::now();

        foreach ($videos as $i => $v) {
            Aswat::updateOrCreate(
                ['link' => 'https://drive.google.com/file/d/' . $v['id'] . '/view'],
                [
                    'title'           => $v['title'],
                    'description'     => '',
                    'thumbnail_image' => 'https://drive.google.com/thumbnail?id=' . $v['id'] . '&sz=w1000',
                    // Stagger newest-first so list order matches the array order.
                    'created_at'      => $base->copy()->subMinutes($i),
                    'updated_at'      => now(),
                ]
            );
        }
    }
}
