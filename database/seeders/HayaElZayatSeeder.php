<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HayaElZayatSeeder extends Seeder
{
    public function run(): void
    {
        $communityId = DB::table('communities')->insertGetId([
            'name'            => 'Haya El Zayat',
            'description'     => 'Senior Researcher at the National Centre for Social Research (NatCen), UK. Research interests span informal labour, precarious work, gender and public policy, and social welfare. MPhil in International Development, University of Oxford.',
            'content'         => '',
            'image'           => null,
            'thumbnail_image' => null,
            'twitter_link'    => '',
            'facebook_link'   => '',
            'linkedin_link'   => '',
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        $this->command->info("Haya El Zayat community entry created (ID: {$communityId}).");
    }
}
