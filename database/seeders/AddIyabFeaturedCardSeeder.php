<?php

namespace Database\Seeders;

use App\Models\FeaturedInitiativeCard;
use Illuminate\Database\Seeder;

/**
 * Add IYAB (Intelligence Yup-Skilling Academy Birzeit) to the home-page
 * "Featured" initiative cards. Idempotent: keyed on the external link so
 * re-running won't create duplicates. The card remains fully editable in
 * the Filament "Featured Initiative Cards" resource (incl. logo upload).
 */
class AddIyabFeaturedCardSeeder extends Seeder
{
    public function run(): void
    {
        FeaturedInitiativeCard::firstOrCreate(
            ['link' => 'https://iyab.io/'],
            [
                'label_en'       => 'IYAB',
                'label_ar'       => 'آياب',
                'sub_label_en'   => 'Birzeit',
                'sub_label_ar'   => 'بيرزيت',
                'image'          => null,
                'title_en'       => 'Intelligence Yup-Skilling Academy Birzeit',
                'title_ar'       => 'أكاديمية بيرزيت للتأهيل المهاري الذكي',
                'link_external'  => true,
                'button_text_en' => 'Visit Website',
                'button_text_ar' => 'زيارة الموقع',
                'button_icon'    => 'fa-external-link-alt',
                'sort_order'     => 6,
                'is_active'      => true,
            ]
        );
    }
}
