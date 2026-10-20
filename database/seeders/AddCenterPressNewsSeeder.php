<?php

namespace Database\Seeders;

use App\Models\countries;
use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Adds external-link cards to the regular News section (featured='no': not
 * Global AI News, not pinned to the homepage) for press/media coverage
 * related to the Center. "Learn More" opens data_link in a new tab. Each
 * item is keyed on data_link, so re-running is idempotent, and its branded
 * cover (committed under seeders/assets/news) is installed onto the public
 * disk. Run as the web user so the cover can be written:
 *
 *     sudo -u www-data php artisan db:seed --class=Database\Seeders\AddCenterPressNewsSeeder --force
 */
class AddCenterPressNewsSeeder extends Seeder
{
    /** @var array<int, array<string, string>> */
    private array $items = [
        [
            'data_link'   => 'https://www.reuters.com/world/middle-east/blind-egyptian-entrepreneurs-ai-app-helps-others-see-world-2026-08-18/',
            'title'       => "Blind Egyptian entrepreneur's AI app helps others 'see' the world",
            'description' => 'Reuters profiles Mark Morad, 20, the blind Cairo developer behind ScribeMe — an AI app that narrates the world for visually impaired users in 20 languages, now on Meta smart glasses and used across 140 countries.',
            'content'     => "Mark Morad began losing his sight in 2018 and, by late 2021, both he and his sister Karen were completely blind. When screen readers fell silent on the charts and equations he needed for school, he taught himself to code and built ScribeMe: an AI-powered app that answers real-time questions through a phone's camera, supports 20 languages including Arabic, and now integrates with Meta's smart glasses so users' hands stay free for a cane. Recognition in technology competitions, including the Vodafone AI Assistive Tools Hackathon in 2024, brought a co-founder and took the app well beyond document scanning; it is used today by thousands of people across 140 countries. Reuters photographed Mark using ScribeMe in a computer lab at The American University in Cairo. Read the full story on Reuters.",
            'date'        => '2026-08-18',
            'thumb'       => 'scribeme-reuters.jpg',
        ],
        [
            'data_link'   => 'https://www.facebook.com/share/p/1BmfyMzUg7/',
            'title'       => "Mohammad El-Taher: A digital ID can't assume everyone has a smartphone",
            'description' => 'In a Facebook video, Mohammad El-Taher argues that with 17.4% illiteracy, 20 million+ Egyptians offline and millions of low-income households, an app-first digital identity risks excluding the people it should serve.',
            'content'     => "Egypt's move toward a digital national identity raises a basic inclusion question: who gets left out when the ID lives in an app? In this video, Mohammad El-Taher points to the numbers — 17.4% of Egyptians are illiterate, more than 20 million are outside internet use, and millions of households are on limited incomes — and argues that a national identity system cannot be built on the assumption that everyone owns a modern smartphone. Any app-first design needs offline and assisted channels so the system serves the whole population, not just the connected. Watch the video on Facebook (in Arabic).",
            'date'        => '2026-09-21',
            'thumb'       => 'digital-id-el-taher.jpg',
        ],
        [
            'data_link'   => 'https://al-fanarmedia.org/2026/09/egypt-ai-day-at-the-american-university-in-cairo-brings-together-experts-and-students/',
            'title'       => 'Egypt AI Day featured on Al-Fanar Media',
            'description' => 'Al-Fanar Media, our media partner for Egypt AI Day, covers the 30 September 2026 event at AUC on "Responsible AI in Practice".',
            'content'     => "We're pleased to highlight Al-Fanar Media, our media partner for Egypt AI Day! Held on 30 September 2026 under the theme \"Responsible AI in Practice,\" Egypt AI Day brought together entrepreneurs, businesses, researchers, practitioners, and students for a day of interactive discussions, hands-on workshops, and knowledge exchange focused on AI literacy and the responsible adoption of artificial intelligence in Egypt. The event was organized by the MENA Observatory on Responsible AI, the Access to Knowledge for Development Center (A2K4D) at the American University in Cairo's Onsi Sawiris School of Business, and Arabi Facts Hub (AFH). We thank Al-Fanar Media for its media partnership and for helping amplify conversations around responsible AI. Read the full article on Al-Fanar Media.",
            'date'        => '2026-09-30',
            'thumb'       => 'egypt-ai-day-al-fanar.jpg',
        ],
    ];

    public function run(): void
    {
        $country = countries::where('name', 'Egypt')->first() ?? countries::first();

        $disk = Storage::disk('public');
        $disk->makeDirectory('news_images');

        foreach ($this->items as $item) {
            $thumbRel = 'news_images/' . $item['thumb'];
            $src = database_path('seeders/assets/news/' . $item['thumb']);
            $written = is_file($src) && $disk->put($thumbRel, file_get_contents($src));
            if (is_file($src) && !$written) {
                // The public disk swallows write failures (no 'throw'), so
                // surface them: usually a permissions issue when artisan is
                // not run as the web user.
                $this->command->error("  Could not write {$disk->path($thumbRel)} — run as the web user (e.g. sudo -u www-data).");
            }

            // Keep an existing cover if this run couldn't write the file.
            $news = News::firstOrNew(['data_link' => $item['data_link']]);
            $news->title       = $item['title'];
            $news->description = $item['description'];
            $news->content     = $item['content'];
            $news->date        = $item['date'];
            $news->featured    = 'no';   // regular news, not Global AI News, not homepage
            $news->country_id  = $country?->id;
            if ($written) {
                $news->image = $thumbRel;
            } elseif (!$news->exists) {
                $news->image = '';
            }
            $news->save();

            $this->command->info('  ' . $item['title'] . ($written ? '' : '  (cover NOT installed)'));
        }

        $this->command->info('Center press coverage: ' . count($this->items) . ' item(s) in regular News.');
    }
}
