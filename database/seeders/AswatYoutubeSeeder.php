<?php

namespace Database\Seeders;

use App\Models\Aswat;
use Illuminate\Database\Seeder;

/**
 * Seeds the "aswat" (voices) home-page section with videos from the
 * MENA Observatory YouTube channel (@MENAObservatory.AI_,
 * channel id UCEmDiZffnpU9iLGpFbdaRWA).
 *
 * Idempotent: keyed on the video link, so re-running updates rather than
 * duplicating. created_at is set to the video's publish date so the
 * section (ordered latest-first) shows newest videos first.
 *
 * Thumbnails use YouTube's auto-generated image; the Aswat::thumbnail_url
 * accessor returns full URLs as-is (admin-uploaded thumbnails still work).
 */
class AswatYoutubeSeeder extends Seeder
{
    public function run(): void
    {
        $videos = [
            ['id' => 'GVaQurPDpSw', 'title' => '"دور النماذج اللغوية الضخمة في الصحافة العربية: الفرص والتحديات والتحولات الإبستمولوجية"', 'published' => '2026-04-08 23:37:35'],
            ['id' => 'O6S9pztSVaI', 'title' => 'Marking a Milestone: RAI Cup Awards & 16 Years of A2K4D', 'published' => '2026-02-15 12:41:03'],
            ['id' => '03iwOzEWtfk', 'title' => 'Digital Labor in the Middle East and Africa: Emerging trends, challenges, and opportunities', 'published' => '2025-12-02 12:10:40'],
            ['id' => 'DYCkZoEGf5w', 'title' => 'AI Ethics for Policy, Perspectives from MENA', 'published' => '2025-11-03 09:26:18'],
            ['id' => 'lvhrperLp0o', 'title' => 'Knowledge Webinar“AI-based Models to Apply in Business” September 8, 2025', 'published' => '2025-09-08 12:09:48'],
            ['id' => '1ctwDM-ooRM', 'title' => 'MENA Observatory on Responsible AI x Aliah Yacoub: AI Explained: MENA Perspectives - Episode 3', 'published' => '2025-08-03 08:16:51'],
            ['id' => 'CFw9tBTc0Mo', 'title' => 'MENA Observatory on Responsible AI x Aliah Yacoub: AI Explained: MENA Perspectives - Episode 2', 'published' => '2025-07-13 10:27:36'],
            ['id' => 'rxu_F4s1d4U', 'title' => 'MENA Observatory on Responsible AI x Aliah Yacoub: AI Explained: MENA Perspectives - Episode 1', 'published' => '2025-06-19 07:18:49'],
            ['id' => 'U5dSlgsdPD4', 'title' => 'What is feminist AI? A talk on growing the Feminist AI Research network’s MENA Hub', 'published' => '2025-05-15 13:02:22'],
            ['id' => 'k4XHl8C5828', 'title' => 'A2K4D and KDEC Explore AI\'s Risks and Opportunities', 'published' => '2025-05-12 08:41:56'],
            ['id' => '-i3G1gBU29o', 'title' => 'The Access to Knowledge for Development Center Celebrates 15 Years of Research, Advocacy, and Impact', 'published' => '2025-04-15 11:10:36'],
            ['id' => 'v2Qf-HhiLPA', 'title' => 'The Access to Knowledge for Development Center (A2K4D) Celebrates its 15th Anniversary!', 'published' => '2025-04-14 08:57:27'],
            ['id' => 'ikB0UQWvTSs', 'title' => 'AI, Gender and Work: Perspectives from the Middle East and Africa', 'published' => '2025-04-10 08:19:58'],
        ];

        foreach ($videos as $v) {
            Aswat::updateOrCreate(
                ['link' => 'https://www.youtube.com/watch?v=' . $v['id']],
                [
                    'title'           => $v['title'],
                    'description'     => '',
                    'thumbnail_image' => 'https://img.youtube.com/vi/' . $v['id'] . '/hqdefault.jpg',
                    'created_at'      => $v['published'],
                    'updated_at'      => now(),
                ]
            );
        }
    }
}
