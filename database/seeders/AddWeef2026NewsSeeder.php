<?php

namespace Database\Seeders;

use App\Models\countries;
use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Adds the MENA-OECD Women's Economic Empowerment Forum (WEEF) 2026 item to the
 * regular News section (featured='no'). It has no external link, so "Learn
 * More" opens its own page: the photo of Nagham ElHoussamy at the OECD is the
 * cover, and both photos sit in the article body. Keyed on the title, so
 * re-running updates it in place. Run as the web user so the photos can be
 * written:
 *
 *     sudo -u www-data php artisan db:seed --class=AddWeef2026NewsSeeder --force
 */
class AddWeef2026NewsSeeder extends Seeder
{
    private const TITLE = "A2K4D at the MENA-OECD Women's Economic Empowerment Forum (WEEF) 2026 in Paris";

    /** Committed under seeders/assets/news, installed to news_images/. */
    private const COVER = 'weef-2026-nagham-elhoussamy.jpg';
    private const GROUP = 'weef-2026-participants.jpg';

    public function run(): void
    {
        $disk = Storage::disk('public');
        $disk->makeDirectory('news_images');

        $installed = [];
        foreach ([self::COVER, self::GROUP] as $file) {
            $rel = 'news_images/' . $file;
            $src = database_path('seeders/assets/news/' . $file);
            if (is_file($src) && $disk->put($rel, file_get_contents($src))) {
                $installed[$file] = $rel;
            } else {
                // The public disk swallows write failures (no 'throw'), so
                // surface them: usually artisan not run as the web user.
                $this->command->error("  Could not write {$disk->path($rel)} — run as the web user (e.g. sudo -u www-data).");
            }
        }

        $cover = '/storage/news_images/' . self::COVER;
        $group = '/storage/news_images/' . self::GROUP;

        $content = <<<HTML
<p>We are pleased to share that Nagham ElHoussamy, Associate Director for Research, Middle East and Africa at the Access to Knowledge for Development Center (A2K4D), is representing A2K4D at the MENA-OECD Women's Economic Empowerment Forum (WEEF) 2026 in Paris.</p>
<img src="{$cover}" alt="Nagham ElHoussamy at the OECD in Paris">
<p>Organized under the MENA-OECD Competitiveness Programme, the Forum brings together key stakeholders to advance gender equality, female entrepreneurship, and women's economic participation across the Middle East and North Africa.</p>
<p>A2K4D's participation reflects its ongoing commitment to advancing women's economic empowerment through research, collaboration, and knowledge-sharing. Through the Inclusive AI Research Network (IAIRN), A2K4D supports multidisciplinary teams across MENA in developing community-driven and inclusive AI solutions that address gender inequalities and local challenges. These initiatives explore how responsible AI can expand women's opportunities in employment, entrepreneurship, financial inclusion, healthcare, and access to services.</p>
<p>Additionally, through its collaboration with Friedrich-Ebert-Stiftung (FES) Egypt, A2K4D conducts research on Women, Work and Informality in Egypt's Digital Economy, examining women's participation in digital entrepreneurship, platform work, and informal employment. The research explores the barriers and opportunities shaping women's economic participation, aiming to inform inclusive, gender-responsive policies that promote economic empowerment, improve working conditions, and support sustainable opportunities for women.</p>
<img src="{$group}" alt="Participants at the MENA-OECD Women's Economic Empowerment Forum 2026 at the OECD in Paris">
<p>Together, these efforts reflect A2K4D's commitment to fostering more inclusive and equitable economic futures across the region.</p>
<p>We look forward to the conversations and collaborations emerging from this important gathering.</p>
<p>#A2K4D #WEEF2026 #WomensEconomicEmpowerment #GenderEquality #IAIRN #InclusiveAI #MENA</p>
HTML;

        $country = countries::where('name', 'Egypt')->first() ?? countries::first();

        $news = News::firstOrNew(['title' => self::TITLE]);
        $news->description = "Nagham ElHoussamy, Associate Director for Research, Middle East and Africa at A2K4D, is representing A2K4D at the MENA-OECD Women's Economic Empowerment Forum (WEEF) 2026 in Paris.";
        $news->content     = $content;
        $news->date        = '2026-11-09';
        $news->data_link   = null;     // its own page, not an external article
        $news->featured    = 'no';     // regular news, not Global AI News, not homepage
        $news->country_id  = $country?->id;
        if (isset($installed[self::COVER])) {
            $news->image = $installed[self::COVER];
        } elseif (!$news->exists) {
            $news->image = '';
        }
        $news->save();

        $this->command->info('  ' . self::TITLE . (count($installed) === 2 ? '' : '  (photos NOT all installed)'));
    }
}
