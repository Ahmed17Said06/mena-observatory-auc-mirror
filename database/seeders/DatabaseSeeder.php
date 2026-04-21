<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Skip user creation if the user already exists
        if (DB::table('users')->where('email', 'admin@argon.com')->count() == 0) {
            DB::table('users')->insert([
                'name' => 'admin',
                'firstname' => 'Admin',
                'lastname' => 'Admin',
                'email' => 'admin@argon.com',
                'password' => bcrypt('secret')
            ]);
        }

        // Insert countries
        foreach (['Algeria', 'Bahrain', 'the Comoros Islands', 'Djibouti', 'Egypt', 'Iraq', 'Jordan',
                 'Kuwait', 'Lebanon', 'Libya', 'Morocco', 'Mauritania', 'Oman',
                 'Palestine', 'Qatar', 'Saudi Arabia', 'Somalia', 'Sudan', 'Syria', 'Tunisia',
                 'United Arab Emirates', 'Yemen'] as $c) {
            DB::table('countries')->insert([
                'name' => $c,
                'ar_name' => $c,
                'intro' => '',
                'right_intro' => '',
                'ar_intro' => '',
                'ar_right_intro' => ''
            ]);
        }

        // Insert themes
        foreach (['Gender & Governance', 'Health', 'Food security, Agriculture and Water Scarcity', 'Innovation and Financial Inclusion'] as $c) {
            DB::table('themes')->insert([
                'name' => $c,
            ]);
        }

        $def = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
        $statics = [
            ['key' => 'Intro', 'content' => $def, 'has_media' => 'no', 'width' => null, 'height' => null, 'page' => 'Home'],
            ['key' => 'About Us Intro', 'content' => $def, 'has_media' => 'no', 'width' => null, 'height' => null, 'page' => 'About Us'],
            ['key' => 'Our Story', 'content' => $def, 'has_media' => 'no', 'width' => null, 'height' => null, 'page' => 'About Us'],
            ['key' => 'vision', 'content' => $def, 'has_media' => 'yes', 'width' => null, 'height' => null, 'page' => 'About Us'],
            ['key' => 'regional intro', 'content' => $def, 'has_media' => 'no', 'width' => null, 'height' => null, 'page' => 'Contact Us'],
            ['key' => 'Objective - 1', 'content' => $def, 'has_media' => 'yes', 'width' => 300, 'height' => 300, 'page' => 'About Us'],
            ['key' => 'Objective - 2', 'content' => $def, 'has_media' => 'yes', 'width' => 300, 'height' => 300, 'page' => 'About Us'],
            ['key' => 'Objective - 3', 'content' => $def, 'has_media' => 'yes', 'width' => 300, 'height' => 300, 'page' => 'About Us'],
            ['key' => 'Objective - 4', 'content' => $def, 'has_media' => 'yes', 'width' => 300, 'height' => 300, 'page' => 'About Us'],
            ['key' => 'Partners Intro', 'content' => $def, 'has_media' => 'no', 'width' => null, 'height' => null, 'page' => 'About Us'],
            ['key' => 'Contact Us Intro', 'content' => $def, 'has_media' => 'no', 'width' => null, 'height' => null, 'page' => 'Contact Us'],
            ['key' => 'community', 'content' => $def, 'has_media' => 'no', 'width' => null, 'height' => null, 'page' => 'community']
        ];
        
        DB::table('statics')->insert($statics);

        $this->call([
            StaticContentSeeder::class,
            StaticSettingsSeeder::class,
            FeministAITalkSeeder::class,
            ArabiFatsHubSeeder::class,
            IrcaiTop100Seeder::class,
            HayaElZayatSeeder::class,
        ]);
    }
}
