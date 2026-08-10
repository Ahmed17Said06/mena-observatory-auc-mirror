<?php

namespace Database\Seeders;

use App\Models\countries;
use App\Models\News;
use Illuminate\Database\Seeder;

/**
 * Adds the MCIT coverage of "Responsible AI Cup 2.0" to the regular News section
 * as an external-link card (clicking "Learn More" opens the MCIT page in a new
 * tab). It is NOT Global AI News (that grid is featured='global_ai') and is not
 * pinned to the homepage (featured='no') — just regular Center news.
 *
 * Keyed on data_link, so re-running is idempotent.
 *
 *     php artisan db:seed --class=Database\\Seeders\\AddRaiCup2McitNewsSeeder --force
 */
class AddRaiCup2McitNewsSeeder extends Seeder
{
    public function run(): void
    {
        $link = 'https://mcit.gov.eg/en/Media_Center/Latest_News/News/116378';

        $country = countries::where('name', 'Egypt')->first() ?? countries::first();

        News::updateOrCreate(
            ['data_link' => $link],
            [
                'title'       => 'Responsible AI Cup 2.0 Launches under Auspices of MCIT',
                'description' => "Under the auspices of Egypt's Ministry of Communications and Information Technology (MCIT), the Access to Knowledge for Development Center (A2K4D) at AUC launches Responsible AI Cup 2.0 with the MENA Observatory on Responsible AI.",
                'content'     => 'The Ministry of Communications and Information Technology (MCIT) is sponsoring the Responsible AI Cup 2.0, a competition organized by the Access to Knowledge for Development Center (A2K4D) at The American University in Cairo\'s Onsi Sawiris School of Business, in partnership with the MENA Observatory on Responsible AI. The initiative supports SMEs and startups building AI systems grounded in transparency, fairness, and accountability. Read the full announcement on the MCIT website.',
                'date'        => '2026-08-09',
                'image'       => '',      // NOT NULL column; no cover supplied (card links out)
                'featured'    => 'no',    // regular news, not Global AI News, not homepage
                'country_id'  => $country?->id,
            ]
        );

        $this->command->info('Added "Responsible AI Cup 2.0 Launches under Auspices of MCIT" to regular News.');
    }
}
