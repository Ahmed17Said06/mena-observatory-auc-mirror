<?php

namespace Database\Seeders;

use App\Models\Aswat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Publishes the MENA Observatory "AI Video Series" episodes to the Aswat tab
 * and installs their branded cards (committed under seeders/assets/aswat)
 * onto the public disk. Each episode is keyed on its Drive link so the
 * seeder is idempotent: re-running updates titles/descriptions/thumbnails in
 * place. The Drive links play inline via the model's embed_url (/preview).
 *
 * To publish a new episode, add it to $episodes (link = the "HD with sub"
 * cut from the series Drive folder) and commit its card, then run:
 *
 *     php artisan db:seed --class=Database\Seeders\AiVideoSeriesSeeder --force
 *
 * Planned (not yet finalised):
 *   EP02: How AI Learns – Machine Learning Explained
 *   EP04: The Responsible AI Challenge – Ethics, Bias & Fairness
 *   EP05: Governing AI – Frameworks, Policy & Our Collective Future
 */
class AiVideoSeriesSeeder extends Seeder
{
    /** @var array<int, array{link: string, title: string, description: string, thumb: string}> */
    private array $episodes = [
        [
            'link'        => 'https://drive.google.com/file/d/1YfBe_ihgsipOTjypmgakLNpKjGOxgVyd/view',
            'title'       => 'AI Video Series – EP01: What Is Artificial Intelligence?',
            'description' => 'Defining AI · A brief history from Turing to today · AI vs. human intelligence · AI in everyday life',
            'thumb'       => 'ai-video-series-ep1.jpg',
        ],
        [
            'link'        => 'https://drive.google.com/file/d/1YtE6wnitZaOegxT5fa9_jGehbjVByjpQ/view',
            'title'       => 'AI Video Series – EP03: AI in Our World – Real Applications Across Sectors',
            'description' => 'AI in healthcare & education · AI in content and media · AI in robotics & automation · Opportunities for the MENA region',
            'thumb'       => 'ai-video-series-ep3.jpg',
        ],
    ];

    public function run(): void
    {
        $disk = Storage::disk('public');
        $disk->makeDirectory('aswat_thumbs');

        foreach ($this->episodes as $ep) {
            $thumbRel = 'aswat_thumbs/' . $ep['thumb'];
            $src = database_path('seeders/assets/aswat/' . $ep['thumb']);
            $hasThumb = is_file($src);
            if ($hasThumb && !$disk->put($thumbRel, file_get_contents($src))) {
                // The public disk swallows write failures (no 'throw'), so
                // surface them: usually a permissions issue when artisan is
                // not run as the web user.
                $this->command->error("  Could not write {$disk->path($thumbRel)} — run as the web user (e.g. sudo -u www-data).");
                $hasThumb = false;
            }

            $attrs = [
                'title'       => $ep['title'],
                'description' => $ep['description'],
            ];
            if ($hasThumb) {
                $attrs['thumbnail_image'] = $thumbRel;
            }

            Aswat::updateOrCreate(['link' => $ep['link']], $attrs);
            $this->command->info('  ' . $ep['title'] . ($hasThumb ? '' : '  (no card found, thumbnail unchanged)'));
        }

        $this->command->info('AI Video Series: ' . count($this->episodes) . ' episode(s) published to Aswat.');
    }
}
