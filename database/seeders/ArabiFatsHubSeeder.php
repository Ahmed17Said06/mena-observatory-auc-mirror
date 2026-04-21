<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArabiFatsHubSeeder extends Seeder
{
    public function run(): void
    {
        $eventTypeId = DB::table('repo_type')->where('name', 'like', '%Event%')->value('id');
        $countryId   = DB::table('countries')->where('name', 'Egypt')->value('id');

        if (!$eventTypeId) {
            $this->command->warn('Could not find an "Events" repo type — skipping.');
            return;
        }

        if (!$countryId) {
            $this->command->warn('Could not find Egypt country — skipping.');
            return;
        }

        $repoId = DB::table('repos')->insertGetId([
            'title'        => 'Arabi Facts Hub x MENA Observatory Webinar',
            'description'  => 'Wednesday, April 8, 2026 | 12:00 – 1:30 PM. A webinar co-hosted by Arabi Facts Hub and the MENA Observatory on Responsible AI at AUC exploring responsible AI in the Arab world.',
            'data_link'    => null,
            'image'        => null,
            'publish_date' => '2026-04-08',
            'country_id'   => $countryId,
            'repo_type_id' => $eventTypeId,
            'is_our_work'  => true,
            'is_global'    => false,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        $this->command->info("Arabi Facts Hub Webinar entry created (Repo ID: {$repoId}).");
    }
}
