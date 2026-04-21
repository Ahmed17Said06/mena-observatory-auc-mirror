<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaticSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'key'       => 'announcement_text',
                'content'   => 'Coming Soon - Convergence Summit, May 2, 2026 | AUC Tahrir Campus | CONVERGENCE: Where Robotics Meets the Human Condition',
                'has_media' => 'no',
                'page'      => 'global',
            ],
            [
                'key'       => 'announcement_link',
                'content'   => 'https://www.convergence-summit.com/',
                'has_media' => 'no',
                'page'      => 'global',
            ],
            [
                'key'       => 'announcement_enabled',
                'content'   => 'yes',
                'has_media' => 'no',
                'page'      => 'global',
            ],
            [
                'key'       => 'social_twitter',
                'content'   => 'https://x.com/MENAObs_AI',
                'has_media' => 'no',
                'page'      => 'global',
            ],
            [
                'key'       => 'social_instagram',
                'content'   => 'https://www.instagram.com/menaobservatory.ai/',
                'has_media' => 'no',
                'page'      => 'global',
            ],
            [
                'key'       => 'social_facebook',
                'content'   => 'https://www.facebook.com/a2k4d/',
                'has_media' => 'no',
                'page'      => 'global',
            ],
            [
                'key'       => 'social_youtube',
                'content'   => 'https://www.youtube.com/@MENAObservatory.AI_',
                'has_media' => 'no',
                'page'      => 'global',
            ],
        ];

        foreach ($items as $item) {
            DB::table('statics')->upsert(
                array_merge($item, ['created_at' => now(), 'updated_at' => now()]),
                ['key'],
                ['content', 'updated_at']
            );
        }

        $this->command->info('Static settings seeded (' . count($items) . ' keys).');
    }
}
