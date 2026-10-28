<?php

namespace Database\Seeders;

use App\Models\Aswat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Publishes the MENA Observatory "AI Video Series" episodes to the Aswat tab
 * and installs their thumbnails, a still from each episode (committed under
 * seeders/assets/aswat), onto the public disk. Each episode is keyed on its Drive link so the
 * seeder is idempotent: re-running updates titles/descriptions/thumbnails in
 * place. The Drive links play inline via the model's embed_url (/preview).
 *
 * To publish a new episode, add it to $episodes (link = the "HD with sub"
 * cut from the series Drive folder) and commit a still from it, then run:
 *
 *     php artisan db:seed --class=Database\Seeders\AiVideoSeriesSeeder --force
 *
 * Planned (not yet finalised):
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
            'link'        => 'https://drive.google.com/file/d/12DwD7QizDlXe7Dz2hPfCYsRELjjvBNSH/view',
            'title'       => 'AI Video Series – EP02: How AI Learns – Machine Learning Explained',
            'description' => 'Episode 2 of the MENA Observatory AI Video Series: how AI systems learn, with machine learning explained.',
            'thumb'       => 'ai-video-series-ep2.jpg',
        ],
        [
            'link'        => 'https://drive.google.com/file/d/1YtE6wnitZaOegxT5fa9_jGehbjVByjpQ/view',
            'title'       => 'AI Video Series – EP03: AI in Our World – Real Applications Across Sectors',
            'description' => 'AI in healthcare & education · AI in content and media · AI in robotics & automation · Opportunities for the MENA region',
            'thumb'       => 'ai-video-series-ep3.jpg',
        ],
        [
            'link'        => 'https://drive.google.com/file/d/1dd6IAVBvZp3yY8DK0q1pyFq9JEjoKQ9m/view',
            'title'       => 'AI Video Series – EP04: The Responsible AI Challenge – Ethics, Bias & Fairness',
            'description' => 'Algorithmic bias and fairness · Transparency and explainability · AI misinformation and deepfakes · Principles of Responsible AI',
            'thumb'       => 'ai-video-series-ep4.jpg',
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

        $this->keepSeriesOrder();

        $this->command->info('AI Video Series: ' . count($this->episodes) . ' episode(s) published to Aswat.');
    }

    /**
     * Aswat lists newest first. Episodes published out of order (EP02 after
     * EP03) would jump ahead of their successors, so give each episode a
     * created_at just before the next one's: the tab then reads EP03, EP02, EP01.
     */
    private function keepSeriesOrder(): void
    {
        $rows = array_map(fn ($ep) => Aswat::where('link', $ep['link'])->first(), $this->episodes);

        for ($i = count($rows) - 2; $i >= 0; $i--) {
            $cur = $rows[$i];
            $next = $rows[$i + 1];
            if ($cur && $next && $cur->created_at >= $next->created_at) {
                Aswat::whereKey($cur->id)->update(['created_at' => $next->created_at->copy()->subMinute()]);
                $cur->created_at = $next->created_at->copy()->subMinute();
            }
        }
    }
}
