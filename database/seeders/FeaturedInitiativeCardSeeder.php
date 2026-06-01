<?php

namespace Database\Seeders;

use App\Models\FeaturedInitiativeCard;
use Illuminate\Database\Seeder;

class FeaturedInitiativeCardSeeder extends Seeder
{
    public function run(): void
    {
        if (FeaturedInitiativeCard::count() > 0) {
            return;
        }

        $cards = [
            [
                'label_en'       => 'Safe AI for Children',
                'label_ar'       => 'الذكاء الاصطناعي الآمن للأطفال',
                'sub_label_en'   => 'MENA Chapter',
                'sub_label_ar'   => 'فرع منطقة الشرق الأوسط وشمال أفريقيا',
                'image'          => null,
                'title_en'       => 'Safe AI For Children - MENA Chapter',
                'title_ar'       => 'الذكاء الاصطناعي الآمن للأطفال - فرع منطقة الشرق الأوسط وشمال أفريقيا',
                'link'           => 'https://i-raise.org/',
                'link_external'  => true,
                'button_text_en' => 'Visit Website',
                'button_text_ar' => 'زيارة الموقع',
                'button_icon'    => 'fa-external-link-alt',
                'sort_order'     => 1,
                'is_active'      => true,
            ],
            [
                'label_en'       => 'Responsible AI Cup',
                'label_ar'       => 'كأس الذكاء الاصطناعي المسؤول',
                'sub_label_en'   => 'Awards Ceremony',
                'sub_label_ar'   => 'حفل توزيع الجوائز',
                'image'          => null,
                'title_en'       => 'Responsible AI Cup Awards Ceremony',
                'title_ar'       => 'حفل ختام كأس الذكاء الاصطناعي المسؤول',
                'link'           => 'news.rai-cup',
                'link_external'  => false,
                'button_text_en' => 'Read More',
                'button_text_ar' => 'اقرأ المزيد',
                'button_icon'    => 'fa-plus',
                'sort_order'     => 2,
                'is_active'      => true,
            ],
            [
                'label_en'       => 'Global Index on Responsible AI',
                'label_ar'       => 'المؤشر العالمي للذكاء الاصطناعي المسؤول',
                'sub_label_en'   => 'GIRAI',
                'sub_label_ar'   => 'جيراي',
                'image'          => null,
                'title_en'       => 'Global Index on Responsible AI',
                'title_ar'       => 'المؤشر العالمي للذكاء الاصطناعي المسؤول',
                'link'           => 'ai_indices',
                'link_external'  => false,
                'button_text_en' => 'Explore Index',
                'button_text_ar' => 'استكشف المؤشر',
                'button_icon'    => 'fa-plus',
                'sort_order'     => 3,
                'is_active'      => true,
            ],
            [
                'label_en'       => 'Future of Work MENA',
                'label_ar'       => 'مستقبل العمل في منطقة الشرق الأوسط وشمال أفريقيا',
                'sub_label_en'   => 'Platform Workers',
                'sub_label_ar'   => 'عمال المنصات',
                'image'          => null,
                'title_en'       => 'Future of Work MENA',
                'title_ar'       => 'مستقبل العمل في منطقة الشرق الأوسط وشمال أفريقيا',
                'link'           => 'pw_mena',
                'link_external'  => false,
                'button_text_en' => 'Read More',
                'button_text_ar' => 'اقرأ المزيد',
                'button_icon'    => 'fa-plus',
                'sort_order'     => 4,
                'is_active'      => true,
            ],
            [
                'label_en'       => 'MENA Observatory',
                'label_ar'       => 'مرصد الشرق الأوسط وشمال أفريقيا',
                'sub_label_en'   => 'Brochures',
                'sub_label_ar'   => 'الكتيبات',
                'image'          => null,
                'title_en'       => 'Observatory Brochures',
                'title_ar'       => 'كتيبات المرصد',
                'link'           => 'brochures.index',
                'link_external'  => false,
                'button_text_en' => 'Browse Brochures',
                'button_text_ar' => 'تصفح الكتيبات',
                'button_icon'    => 'fa-plus',
                'sort_order'     => 5,
                'is_active'      => true,
            ],
        ];

        foreach ($cards as $card) {
            FeaturedInitiativeCard::create($card);
        }
    }
}
