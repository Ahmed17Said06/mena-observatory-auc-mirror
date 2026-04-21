<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IrcaiTop100Seeder extends Seeder
{
    public function run(): void
    {
        $countryId = DB::table('countries')->where('name', 'Egypt')->value('id');

        $newsId = DB::table('news')->insertGetId([
            'title'       => 'MENA AI Observatory Selected in IRCAI Top 100 2025',
            'description' => 'Honored to be selected as an Early Stage project in the IRCAI Top 100 2025 – Global Index of AI Innovations. Recognized among outstanding initiatives advancing AI for sustainability and the UN SDGs.',
            'content'     => '<p>The MENA Observatory on Responsible AI at AUC has been selected as an Early Stage project in the <strong>IRCAI Top 100 2025</strong> – the Global Index of AI Innovations. This recognition highlights the Observatory\'s contributions to advancing responsible and inclusive AI in the MENA region in alignment with the UN Sustainable Development Goals.</p>',
            'data_link'   => 'https://ircai.org/top100/entry/mena-ai-observatory/',
            'image'       => null,
            'date'        => '2025-01-01',
            'featured'    => 'no',
            'country_id'  => $countryId,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        $this->command->info("IRCAI Top 100 news entry created (News ID: {$newsId}).");
    }
}
