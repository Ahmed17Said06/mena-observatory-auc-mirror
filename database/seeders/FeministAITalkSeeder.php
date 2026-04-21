<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeministAITalkSeeder extends Seeder
{
    public function run()
    {
        // Look up IDs by name so this works regardless of insertion order
        $eventTypeId = DB::table('repo_type')->where('name', 'like', '%Event%')->value('id');
        $countryId   = DB::table('countries')->where('name', 'Egypt')->value('id');
        $genderTagId = DB::table('repo_tags')->where('name', 'like', '%Gender%')->value('id');

        if (!$eventTypeId) {
            $this->command->warn('Could not find an "Events" repo type — skipping.');
            return;
        }

        if (!$countryId) {
            $this->command->warn('Could not find Egypt country — skipping.');
            return;
        }

        $repoId = DB::table('repos')->insertGetId([
            'title'        => '"What is Feminist Artificial Intelligence? Perspectives from the Middle East and North Africa"',
            'description'  => 'Johns Hopkins Berman Institute of Bioethics Seminar Series, Spring 2026. A talk exploring the meaning and need for a feminist lens in addressing issues related to AI and inclusion, with examples from the MENA Observatory on Responsible AI at AUC.',
            'data_link'    => 'https://bioethics.jhu.edu/events/seminar-series-virtual-talk-with-nagla-rizk-phd/',
            'image'        => 'placeholder-featured.jpg',
            'publish_date' => '2026-02-09',
            'country_id'   => $countryId,
            'repo_type_id' => $eventTypeId,
            'is_our_work'  => true,
            'is_global'    => false,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // Attach Gender tag if found
        if ($genderTagId) {
            DB::table('taggables')->insert([
                'repo_tags_id'   => $genderTagId,
                'taggable_id'    => $repoId,
                'taggable_type'  => 'App\\Models\\Repo',
            ]);
        }

        $this->command->info("Feminist AI talk entry created (Repo ID: {$repoId}).");
    }
}
