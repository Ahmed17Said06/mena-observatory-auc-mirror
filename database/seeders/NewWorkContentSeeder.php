<?php

namespace Database\Seeders;

use App\Models\static_content;
use Illuminate\Database\Seeder;

class NewWorkContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        static_content::updateOrCreate(
            ['key' => 'new_work_description'],
            [
                'content' => '<p>Fast and wide-ranging developments in technology have redefined employment relationships around the globe, giving rise to many new forms of work. Platform-mediated work emerged as a way to connect workers to buyers of a labor service— and indeed it has provided millions of individuals around the world with access to work, especially in developing countries— although often at a cost.</p><p>Our research on platform work in the MENA region aims to influence the global narrative on platform work by giving perspectives from MENA and the larger Global South. By identifying regional opportunities and challenges, we aim to promote inclusive policy making with regards to work and safety nets, and sustainable livelihoods for all.</p><p>Explore our reports, policy briefs, and blog posts to find out more.</p>',
                'ar_content' => '<p>أدت التطورات السريعة والواسعة النطاق في التكنولوجيا إلى إعادة تعريف علاقات العمل في جميع أنحاء العالم، مما أدى إلى ظهور أشكال جديدة كثيرة من العمل. ظهر العمل بوساطة المنصات كوسيلة لربط العمال بمشتري الخدمات العمالية - وقد وفر بالفعل لملايين الأفراد حول العالم إمكانية الوصول إلى العمل، خاصة في البلدان النامية - وإن كان ذلك في كثير من الأحيان بتكلفة.</p><p>تهدف أبحاثنا حول عمل المنصات في منطقة الشرق الأوسط وشمال أفريقيا إلى التأثير على السرد العالمي حول عمل المنصات من خلال تقديم وجهات نظر من الشرق الأوسط وشمال أفريقيا والجنوب العالمي الأوسع. من خلال تحديد الفرص والتحديات الإقليمية، نهدف إلى تعزيز صنع السياسات الشامل فيما يتعلق بالعمل وشبكات الأمان، وسبل العيش المستدامة للجميع.</p><p>استكشف تقاريرنا وموجزات السياسات ومنشورات المدونة لمعرفة المزيد.</p>',
                'has_media' => 'no',
                'page' => 'New Work'
            ]
        );
    }
}
