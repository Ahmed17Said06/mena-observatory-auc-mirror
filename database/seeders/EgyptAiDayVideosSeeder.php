<?php

namespace Database\Seeders;

use App\Models\Aswat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Publishes the Egypt AI Day 2026 videos (30 September 2026, AUC) to the
 * Aswat tab: the two event reels (ver2 cuts) and Mark Morad's interview
 * (ver3 cut), with thumbnails committed under seeders/assets/aswat. Keyed on
 * the Drive link, so re-running updates titles/descriptions/thumbnails in
 * place. The Drive links play inline via the model's embed_url (/preview).
 *
 *     php artisan db:seed --class=Database\Seeders\EgyptAiDayVideosSeeder --force
 */
class EgyptAiDayVideosSeeder extends Seeder
{
    /** Listed in the order they should read on the tab (first = top). */
    private array $videos = [
        [
            'link'        => 'https://drive.google.com/file/d/1KcxmoBfeHec37JkKE2JT5ZaW49u7tPhe/view',
            'title'       => 'Egypt AI Day 2026 – Event Highlights, Part 1',
            'description' => 'Highlights from Egypt AI Day, held on 30 September 2026 at AUC under the theme "Responsible AI in Practice" and organized by the MENA Observatory on Responsible AI, A2K4D and Arabi Facts Hub.',
            'thumb'       => 'egypt-ai-day-2026-part1.jpg',
        ],
        [
            'link'        => 'https://drive.google.com/file/d/1fmnXAEX5goUiBL34KFe8Tv7bgBfhNCaP/view',
            'title'       => 'Egypt AI Day 2026 – Event Highlights, Part 2',
            'description' => 'More from Egypt AI Day 2026: a day of discussions, hands-on workshops and knowledge exchange on AI literacy and the responsible adoption of AI in Egypt.',
            'thumb'       => 'egypt-ai-day-2026-part2.jpg',
        ],
        [
            'link'        => 'https://drive.google.com/file/d/1uzhJu_G01ZvMi1eoLAE2HUKN1lMmzU4Q/view',
            'title'       => 'Egypt AI Day 2026 – Interview with Mark Morad',
            'description' => "Mark Morad, the blind developer behind ScribeMe, on how the AI app helps visually impaired people study and get through daily life, why user feedback shapes every feature, and how his team tests for accuracy and protects users' data.",
            'thumb'       => 'egypt-ai-day-2026-mark-morad.jpg',
        ],
    ];

    public function run(): void
    {
        $disk = Storage::disk('public');
        $disk->makeDirectory('aswat_thumbs');

        foreach ($this->videos as $v) {
            $thumbRel = 'aswat_thumbs/' . $v['thumb'];
            $src = database_path('seeders/assets/aswat/' . $v['thumb']);
            $hasThumb = is_file($src);
            if ($hasThumb && !$disk->put($thumbRel, file_get_contents($src))) {
                // The public disk swallows write failures (no 'throw'), so
                // surface them: usually a permissions issue when artisan is
                // not run as the web user.
                $this->command->error("  Could not write {$disk->path($thumbRel)} — run as the web user (e.g. sudo -u www-data).");
                $hasThumb = false;
            }

            $aswat = Aswat::firstOrNew(['link' => $v['link']]);
            $aswat->title       = $v['title'];
            $aswat->description = $v['description'];
            if ($hasThumb) {
                $aswat->thumbnail_image = $thumbRel;
            } elseif (!$aswat->exists) {
                $aswat->thumbnail_image = '';
            }
            $aswat->save();

            $this->command->info('  ' . $v['title'] . ($hasThumb ? '' : '  (no thumbnail found)'));
        }

        $this->keepListedOrder();

        $this->command->info('Egypt AI Day: ' . count($this->videos) . ' video(s) published to Aswat.');
    }

    /**
     * Aswat lists newest first. Give each video a created_at just before the
     * one listed above it, so the tab reads in $videos order even when a row
     * is added on a later run.
     */
    private function keepListedOrder(): void
    {
        $rows = array_map(fn ($v) => Aswat::where('link', $v['link'])->first(), $this->videos);

        for ($i = 1; $i < count($rows); $i++) {
            $prev = $rows[$i - 1];
            $cur = $rows[$i];
            if ($prev && $cur && $cur->created_at >= $prev->created_at) {
                $cur->created_at = $prev->created_at->copy()->subMinute();
                Aswat::whereKey($cur->id)->update(['created_at' => $cur->created_at]);
            }
        }
    }
}
