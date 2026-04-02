<?php

namespace Database\Seeders;

use App\Models\static_content;
use Illuminate\Database\Seeder;

class StaticContentSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // ── About Us ─────────────────────────────────────────────────────
            [
                'key'        => 'About Us Intro',
                'page'       => 'About Us',
                'has_media'  => 'no',
                'content'    => 'Advancing responsible AI for development and inclusion across the MENA region.',
                'ar_content' => 'تعزيز الذكاء الاصطناعي المسؤول من أجل التنمية والشمول في منطقة الشرق الأوسط وشمال أفريقيا.',
            ],
            [
                'key'        => 'vision',
                'page'       => 'About Us',
                'has_media'  => 'no',
                'content'    => '"A dynamic, inclusive and locally-driven platform on responsible AI in MENA — a catalyst for change: a tool for policy making, a hub for connecting stakeholders, and the go-to home for knowledge on responsible AI as it pertains to everyone in the region."',
                'ar_content' => '"منصة ديناميكية وشاملة ومحلية الطابع حول الذكاء الاصطناعي المسؤول في منطقة الشرق الأوسط وشمال أفريقيا — محفّز للتغيير: أداة لصنع السياسات، ومحور لربط أصحاب المصلحة، ومرجع معرفي للجميع في المنطقة."',
            ],
            [
                'key'        => 'Objective - 1',
                'page'       => 'About Us',
                'has_media'  => 'no',
                'content'    => 'Informing and influencing evidence-based policy making on responsible data and AI, ensuring MENA perspectives shape governance frameworks regionally and globally.',
                'ar_content' => 'إثراء وتأثير صنع السياسات القائمة على الأدلة في مجال البيانات والذكاء الاصطناعي المسؤولين، وضمان تشكيل وجهات نظر منطقة الشرق الأوسط وشمال أفريقيا لأطر الحوكمة إقليمياً وعالمياً.',
            ],
            [
                'key'        => 'Objective - 2',
                'page'       => 'About Us',
                'has_media'  => 'no',
                'content'    => 'Advancing inclusive, community-driven approaches to AI development that reflect regional nuances, promote gender equity, and support sustainable development goals.',
                'ar_content' => 'تعزيز مناهج شاملة ومجتمعية لتطوير الذكاء الاصطناعي تعكس خصوصيات المنطقة، وتعزز المساواة بين الجنسين، وتدعم أهداف التنمية المستدامة.',
            ],
            [
                'key'        => 'Objective - 3',
                'page'       => 'About Us',
                'has_media'  => 'no',
                'content'    => 'Connecting communities, raising awareness, and empowering individuals — from researchers and policymakers to civil society and beneficiaries — to engage with and benefit from responsible AI.',
                'ar_content' => 'ربط المجتمعات، ورفع الوعي، وتمكين الأفراد — من الباحثين وصانعي السياسات إلى المجتمع المدني والمستفيدين — للمشاركة والاستفادة من الذكاء الاصطناعي المسؤول.',
            ],

            // ── Knowledge Hub Cards (regional.blade.php) ─────────────────────
            [
                'key'        => 'kh_our_work_desc',
                'page'       => 'Knowledge Hub',
                'has_media'  => 'no',
                'content'    => 'Research, publications, and reports produced by our team on responsible AI in the MENA region.',
                'ar_content' => 'أبحاث ومنشورات وتقارير أنتجها فريقنا حول الذكاء الاصطناعي المسؤول في المنطقة.',
            ],
            [
                'key'        => 'kh_regional_work_desc',
                'page'       => 'Knowledge Hub',
                'has_media'  => 'no',
                'content'    => 'External research and resources from the MENA region on AI and data governance.',
                'ar_content' => 'أبحاث ومصادر خارجية من المنطقة تتناول الذكاء الاصطناعي والبيانات.',
            ],
            [
                'key'        => 'kh_global_work_desc',
                'page'       => 'Knowledge Hub',
                'has_media'  => 'no',
                'content'    => 'A curated collection of international research and resources on responsible AI worldwide.',
                'ar_content' => 'مجموعة منسقة من الأبحاث والموارد الدولية حول الذكاء الاصطناعي المسؤول.',
            ],

            // ── Featured Page Cards (featured-page.blade.php) ────────────────
            [
                'key'        => 'featured_safe_ai_title',
                'page'       => 'Featured',
                'has_media'  => 'no',
                'content'    => 'Safe AI for Children - MENA Chapter',
                'ar_content' => 'الذكاء الاصطناعي الآمن للأطفال - فرع منطقة الشرق الأوسط وشمال أفريقيا',
            ],
            [
                'key'        => 'featured_safe_ai_desc',
                'page'       => 'Featured',
                'has_media'  => 'no',
                'content'    => 'The International Coalition for AI Safety for Children (i-raise)',
                'ar_content' => 'التحالف الدولي لسلامة الذكاء الاصطناعي للأطفال (i-raise)',
            ],
            [
                'key'        => 'featured_rai_cup_title',
                'page'       => 'Featured',
                'has_media'  => 'no',
                'content'    => 'Responsible AI Cup Awards Ceremony',
                'ar_content' => 'حفل ختام كأس الذكاء الاصطناعي المسؤول',
            ],
            [
                'key'        => 'featured_rai_cup_subtitle',
                'page'       => 'Featured',
                'has_media'  => 'no',
                'content'    => 'Under the Patronage of MCIT - January 18, 2026',
                'ar_content' => 'تحت رعاية وزارة الاتصالات وتكنولوجيا المعلومات - 18 يناير 2026',
            ],
            [
                'key'        => 'featured_girai_title',
                'page'       => 'Featured',
                'has_media'  => 'no',
                'content'    => 'Global Index on Responsible AI',
                'ar_content' => 'المؤشر العالمي للذكاء الاصطناعي المسؤول',
            ],
            [
                'key'        => 'featured_girai_desc',
                'page'       => 'Featured',
                'has_media'  => 'no',
                'content'    => 'Explore how countries across the MENA region are adopting responsible AI practices with the GIRAI assessment framework.',
                'ar_content' => 'استكشف كيف تتبنى دول منطقة الشرق الأوسط وشمال أفريقيا ممارسات الذكاء الاصطناعي المسؤول.',
            ],
            [
                'key'        => 'featured_pw_mena_title',
                'page'       => 'Featured',
                'has_media'  => 'no',
                'content'    => 'Future of Work MENA',
                'ar_content' => 'مستقبل العمل في منطقة الشرق الأوسط وشمال أفريقيا',
            ],
            [
                'key'        => 'featured_pw_mena_desc',
                'page'       => 'Featured',
                'has_media'  => 'no',
                'content'    => 'Our research on platform work in the MENA region',
                'ar_content' => 'بحثنا حول عمال المنصات الرقمية في منطقة الشرق الأوسط وشمال أفريقيا',
            ],

            // ── Feminist AI — Pillars & CTA ───────────────────────────────────
            [
                'key'        => 'fai_pillar_1_title',
                'page'       => 'Feminist AI',
                'has_media'  => 'no',
                'content'    => 'Algorithmic Bias & Discrimination',
                'ar_content' => 'التحيز الخوارزمي والتمييز',
            ],
            [
                'key'        => 'fai_pillar_1_desc',
                'page'       => 'Feminist AI',
                'has_media'  => 'no',
                'content'    => 'Examining how AI systems encode and amplify gender biases in hiring, credit scoring, healthcare, and content moderation, with a focus on MENA-specific contexts.',
                'ar_content' => '',
            ],
            [
                'key'        => 'fai_pillar_2_title',
                'page'       => 'Feminist AI',
                'has_media'  => 'no',
                'content'    => 'Inclusive AI Governance',
                'ar_content' => 'حوكمة الذكاء الاصطناعي الشاملة',
            ],
            [
                'key'        => 'fai_pillar_2_desc',
                'page'       => 'Feminist AI',
                'has_media'  => 'no',
                'content'    => 'Advocating for gender-responsive AI policies and governance frameworks that center the needs and rights of women and marginalized groups in AI regulation.',
                'ar_content' => '',
            ],
            [
                'key'        => 'fai_pillar_3_title',
                'page'       => 'Feminist AI',
                'has_media'  => 'no',
                'content'    => 'Digital Safety & Online Violence',
                'ar_content' => 'السلامة الرقمية والعنف الإلكتروني',
            ],
            [
                'key'        => 'fai_pillar_3_desc',
                'page'       => 'Feminist AI',
                'has_media'  => 'no',
                'content'    => 'Researching how AI-powered platforms enable or fail to prevent gender-based online violence, and how automated systems can better protect women and LGBTQ+ communities.',
                'ar_content' => '',
            ],
            [
                'key'        => 'fai_pillar_4_title',
                'page'       => 'Feminist AI',
                'has_media'  => 'no',
                'content'    => 'Women in AI & Tech',
                'ar_content' => 'المرأة في الذكاء الاصطناعي والتكنولوجيا',
            ],
            [
                'key'        => 'fai_pillar_4_desc',
                'page'       => 'Feminist AI',
                'has_media'  => 'no',
                'content'    => 'Tracking gender representation in the AI workforce across MENA, supporting women researchers, engineers, and policymakers shaping the field\'s future.',
                'ar_content' => '',
            ],
            [
                'key'        => 'fai_cta_title',
                'page'       => 'Feminist AI',
                'has_media'  => 'no',
                'content'    => 'Advance Gender Justice in AI',
                'ar_content' => 'تعزيز العدالة الجندرية في الذكاء الاصطناعي',
            ],
            [
                'key'        => 'fai_cta_text',
                'page'       => 'Feminist AI',
                'has_media'  => 'no',
                'content'    => 'Join researchers, policymakers, and advocates working to make AI more equitable for everyone in the MENA region.',
                'ar_content' => 'انضم إلى الباحثين وصانعي السياسات والمناصرين العاملين على جعل الذكاء الاصطناعي أكثر عدالة للجميع.',
            ],

            // ── RAI Cup Page ──────────────────────────────────────────────────
            [
                'key'        => 'rai_cup_hero_title',
                'page'       => 'RAI Cup',
                'has_media'  => 'no',
                'content'    => 'Responsible AI Cup Awards Ceremony',
                'ar_content' => 'حفل ختام كأس الذكاء الاصطناعي المسؤول',
            ],
            [
                'key'        => 'rai_cup_hero_subtitle',
                'page'       => 'RAI Cup',
                'has_media'  => 'no',
                'content'    => 'Under the Patronage of the Ministry of Communications and Information Technology (MCIT)',
                'ar_content' => 'تحت رعاية وزارة الاتصالات وتكنولوجيا المعلومات',
            ],
            [
                'key'        => 'rai_cup_event_date',
                'page'       => 'RAI Cup',
                'has_media'  => 'no',
                'content'    => 'Sunday, January 18, 2026',
                'ar_content' => 'الأحد 18 يناير 2026',
            ],
            [
                'key'        => 'rai_cup_event_location',
                'page'       => 'RAI Cup',
                'has_media'  => 'no',
                'content'    => 'Founders Spaces, Downtown Cairo',
                'ar_content' => 'مساحة فاوندَرْز، وسط القاهرة',
            ],
            [
                'key'        => 'rai_cup_body',
                'page'       => 'RAI Cup',
                'has_media'  => 'no',
                'content'    => '<p>The American University in Cairo (AUC) represented by Access to Knowledge for Development (A2K4D) at Onsi Sawiris School of Business will host the Inaugural Responsible AI Cup Awards Ceremony on Sunday, January 18, 2026, at Founders Spaces, Downtown Cairo. The event is held under the patronage of the Ministry of Communications and Information Technology (MCIT) and marks the conclusion of the Responsible AI (RAI) Cup competition, while also celebrating the 16th anniversary of Access to Knowledge for Development (A2K4D) Center. The RAI competition is an initiative of A2K4D\'s flagship MENA Observatory on Responsible AI, advocating for responsible AI policies and practices across the MENA region.</p><p>The RAI Cup competition was launched in October 2025 as the first competition in Egypt for Small and Medium Enterprises (SMEs) and startups building or using artificial intelligence (AI) in their tech solutions, with a primary focus on fostering responsible AI themes and practices. The competition brought together submissions from 41 companies demonstrating their commitment to responsible AI across nine pillars: privacy, accountability, safety, transparency, fairness, human oversight, professional responsibility and human values. The submissions were then evaluated and the top five participants were selected to showcase their pitches on the upcoming awards ceremony day.</p><div class="finalists-box"><h3>Finalists</h3><p>Rology, Cloudilic, AgriCan, Cluster and Zaher AI</p><p>The first, second and third places will receive financial awards from A2K4D, and the fourth and fifth places will receive honorary awards.</p></div><p>The RAI Cup aims at incentivizing SMEs and startups in Egypt and the MENA region, to implement responsible AI and recognize responsible practices that are already in place. It also seeks to raise awareness about ethical, legal and environmental implications of AI. The RAI Cup provides a space for entrepreneurs to collaborate with each other, as well as with experts from academia and the AI ecosystem. Grounded in capacity building, the RAI Cup competition gave participants the opportunity to grow their skills through educational content and training in responsible AI.</p><p>The ceremony will bring together prominent figures from the AI startup ecosystem, experienced judges and invited guests from the MENA Observatory on Responsible AI, alongside members of A2K4D\'s regional and international networks. The event aims to highlight innovative approaches to responsible and ethical artificial intelligence while fostering dialogue among policymakers, practitioners and innovators.</p><p>The program will feature finalist pitches from the Responsible AI Cup, followed by the announcement of award recipients in recognition of exceptional approaches to responsible AI. The event will also include an engaging discussion on responsible AI and conclude with a reflection on A2K4D\'s achievements and impact in 2025.</p><div class="judges-list"><h3>Panel of Judges</h3><ul><li><strong>Hoda Baraka</strong> - Advisor to Minister of Communications and Information Technology and professor of computer engineering, Cairo University</li><li><strong>Nezar Sami</strong> - Skills development analyst, Regional Programme for Arab States (RBAS), Regional Programme Division, United Nations Development Programme UNDP</li><li><strong>Ayman Ismail</strong> - Abdul Latif Jameel Endowed Chair of Entrepreneurship, associate professor, Onsi Sawiris School of Business, and founding director of AUC Venture Lab, The American University in Cairo</li><li><strong>Lamiaa El Rashidi</strong> - Senior manager, Incubation Department, Technology Innovation and Entrepreneurship Center (TIEC)</li></ul></div><p>By convening key stakeholders from academia, government and the private sector, the Responsible AI Cup Awards Ceremony underscores AUC\'s and A2K4D\'s commitment to advancing responsible AI practices and supporting innovation that aligns with societal values and inclusive development.</p>',
                'ar_content' => '<p>سيستضيف مركز إتاحة المعرفة من أجل التنمية (A2K4D) بكلية أنسي ساويرس لإدارة الأعمال بالجامعة الأمريكية بالقاهرة حفل ختام النسخة الأولى من مسابقة كأس الذكاء الاصطناعي المسؤول يوم الأحد 18 يناير 2026 في مساحة فاوندَرْز، وسط القاهرة (وسط البلد)، تحت رعاية وزارة الاتصالات وتكنولوجيا المعلومات.</p><p>أُطلقت مسابقة كأس الذكاء الاصطناعي المسؤول في أكتوبر 2025 باعتبارها أول مسابقة من نوعها في مصر تستهدف الشركات الصغيرة والمتوسطة والشركات الناشئة.</p><div class="finalists-box"><h3>الفرق المتأهلة للمرحلة النهائية</h3><p>Rology، Cloudilic، AgriCan، Cluster، وZaher AI</p><p>ويحصل الفائزون بالمراكز الأول والثاني والثالث على جوائز مالية مقدمة من مركز A2K4D، فيما يحصل صاحبا المركزين الرابع والخامس على جوائز تقديرية.</p></div><div class="judges-list"><h3>لجنة التحكيم النهائية</h3><ul><li><strong>د.هدى بركة</strong> - مستشار وزير الاتصالات وتكنولوجيا المعلومات وأستاذ هندسة الحاسبات، جامعة القاهرة</li><li><strong>د. نزار سامي</strong> - خبير تنمية المهارات، برنامج الأمم المتحدة الإنمائي (UNDP)</li><li><strong>د. أيمن إسماعيل</strong> - مدرس وأستاذ كرسي عبد اللطيف جميل لريادة الأعمال بكلية أنسي ساويرس</li><li><strong>م. لمياء الرشيدي</strong> - مدير إدارة الحاضنات بمركز الإبداع وريادة الأعمال</li></ul></div>',
            ],

            // ── Open Call: Applied Inclusive AI Solutions ─────────────────────
            [
                'key'        => 'ocais_hero_title',
                'page'       => 'Open Call AI Solutions',
                'has_media'  => 'no',
                'content'    => 'Final Call for Submissions — Open Call for Applied Inclusive AI Solutions – MENA Region',
                'ar_content' => '',
            ],
            [
                'key'        => 'ocais_hero_subtitle',
                'page'       => 'Open Call AI Solutions',
                'has_media'  => 'no',
                'content'    => 'MENA Observatory on Responsible AI at A2K4D',
                'ar_content' => '',
            ],
            [
                'key'        => 'ocais_body',
                'page'       => 'Open Call AI Solutions',
                'has_media'  => 'no',
                'content'    => '<p>This is the final reminder to submit proposals to the Open Call launched by the MENA Observatory on Responsible AI at A2K4D, the MENA Hub of the Global Catalyzing Inclusive AI Research Network (CIARN).</p><p>We are inviting multidisciplinary teams of innovators, researchers, technologists, gender experts, and social scientists to submit inclusive, gender-transformative, and community-driven AI prototypes and pilot projects that address bias, support marginalized communities, and strengthen responsible AI ecosystems across the MENA region.</p><p><strong>If your work aims to make AI fairer, safer, more inclusive, and locally relevant, this is your last chance to apply.</strong></p>',
                'ar_content' => '',
            ],

            // ── Open Call: Responsible AI Use Cases ──────────────────────────
            [
                'key'        => 'ocruc_hero_title',
                'page'       => 'Open Call RAI Use Cases',
                'has_media'  => 'no',
                'content'    => 'Open Call for Responsible AI Use Cases — MENA Region',
                'ar_content' => '',
            ],
            [
                'key'        => 'ocruc_hero_subtitle',
                'page'       => 'Open Call RAI Use Cases',
                'has_media'  => 'no',
                'content'    => 'MENA Observatory on Responsible AI at A2K4D, Onsi Sawiris School of Business, AUC',
                'ar_content' => '',
            ],
            [
                'key'        => 'ocruc_body',
                'page'       => 'Open Call RAI Use Cases',
                'has_media'  => 'no',
                'content'    => '<p>The MENA Observatory on Responsible AI: a flagship initiative by A2K4D at the Onsi Sawiris School of Business, AUC is seeking proposals for practical, responsible AI solutions that advance inclusion, reduce inequalities, and address sector-specific challenges in the region.</p><p><strong>If you are developing an early-stage or prototype AI solution aligned with Responsible AI principles, this call is for you.</strong></p>',
                'ar_content' => '',
            ],

            // ── News Page Static Cards ────────────────────────────────────────
            [
                'key'        => 'news_card_1_title',
                'page'       => 'News',
                'has_media'  => 'yes',
                'content'    => 'Final Call for Submissions Open Call for Applied Inclusive AI Solutions – MENA Region',
                'ar_content' => '',
            ],
            [
                'key'        => 'news_card_1_desc',
                'page'       => 'News',
                'has_media'  => 'no',
                'content'    => 'This is the final reminder to submit proposals to the Open Call launched by the MENA Observatory on Responsible AI at A2K4D.',
                'ar_content' => '',
            ],
            [
                'key'        => 'news_card_2_title',
                'page'       => 'News',
                'has_media'  => 'yes',
                'content'    => 'Open Call for Responsible AI Use Cases - MENA Region',
                'ar_content' => '',
            ],
            [
                'key'        => 'news_card_2_desc',
                'page'       => 'News',
                'has_media'  => 'no',
                'content'    => 'The MENA Observatory on Responsible AI is seeking proposals for practical, responsible AI solutions.',
                'ar_content' => '',
            ],
            [
                'key'        => 'news_card_3_title',
                'page'       => 'News',
                'has_media'  => 'yes',
                'content'    => 'Nagla Rizk Contributes to Le Monde article on Education and AI Equity',
                'ar_content' => '',
            ],
            [
                'key'        => 'news_card_3_desc',
                'page'       => 'News',
                'has_media'  => 'no',
                'content'    => 'AI could be a powerful lever to reduce inequalities between different socio-cultural backgrounds.',
                'ar_content' => '',
            ],
            [
                'key'        => 'news_card_3_link',
                'page'       => 'News',
                'has_media'  => 'no',
                'content'    => 'https://www.lemonde.fr/idees/article/2025/10/29/l-ia-pourrait-representer-un-puissant-levier-pour-reduire-les-inegalites-entre-differents-milieux-socioculturels_6650132_3232.html',
                'ar_content' => '',
            ],
            [
                'key'        => 'news_card_3_btn',
                'page'       => 'News',
                'has_media'  => 'no',
                'content'    => 'Read Article',
                'ar_content' => 'اقرأ المقال',
            ],

            // ── Future of Work (PW Mena) Page ─────────────────────────────────
            [
                'key'        => 'pw_mena_description',
                'page'       => 'Future of Work',
                'has_media'  => 'no',
                'content'    => '<p>Fast and wide-ranging developments in technology have redefined employment relationships around the globe, giving rise to many new forms of work. Platform-mediated work emerged as a way to connect workers to buyers of a labor service— and indeed it has provided millions of individuals around the world with access to work, especially in developing countries— although often at a cost.</p><p>Our research on platform work in the MENA region aims to influence the global narrative on platform work by giving perspectives from MENA and the larger Global South. By identifying regional opportunities and challenges, we aim to promote inclusive policy making with regards to work and safety nets, and sustainable livelihoods for all.</p>',
                'ar_content' => '',
            ],
            [
                'key'        => 'pw_mena_disclaimer',
                'page'       => 'Future of Work',
                'has_media'  => 'no',
                'content'    => '<strong>Note:</strong> Fieldwork for these reports was conducted in Fall/Winter 2023. Analysis and recommendations are based on that timeline.',
                'ar_content' => '<strong>ملاحظة:</strong> تم إجراء العمل الميداني لهذه التقارير في خريف/شتاء 2023. يستند التحليل والتوصيات إلى هذا الجدول الزمني.',
            ],
            [
                'key'        => 'pw_mena_inst_auc_name',
                'page'       => 'Future of Work',
                'has_media'  => 'no',
                'content'    => 'Access to Knowledge for Development Center',
                'ar_content' => 'مركز إتاحة المعرفة من أجل التنمية',
            ],
            [
                'key'        => 'pw_mena_inst_auc_org',
                'page'       => 'Future of Work',
                'has_media'  => 'no',
                'content'    => 'AUC Onsi Sawiris School of Business',
                'ar_content' => 'كلية أنسي ساويرس لإدارة الأعمال، الجامعة الأمريكية بالقاهرة',
            ],
            [
                'key'        => 'pw_mena_inst_policy_hub_name',
                'page'       => 'Future of Work',
                'has_media'  => 'no',
                'content'    => 'The Policy Hub',
                'ar_content' => 'مركز السياسات',
            ],
            [
                'key'        => 'pw_mena_inst_policy_hub_org',
                'page'       => 'Future of Work',
                'has_media'  => 'no',
                'content'    => 'Lebanon',
                'ar_content' => 'لبنان',
            ],
            [
                'key'        => 'pw_mena_inst_phenix_name',
                'page'       => 'Future of Work',
                'has_media'  => 'no',
                'content'    => 'Phenix Center for Economic and Information Studies',
                'ar_content' => 'مركز فينيكس للدراسات الاقتصادية والمعلوماتية',
            ],
            [
                'key'        => 'pw_mena_inst_phenix_org',
                'page'       => 'Future of Work',
                'has_media'  => 'no',
                'content'    => 'Jordan',
                'ar_content' => 'الأردن',
            ],
            [
                'key'        => 'pw_mena_inst_tunisia_name',
                'page'       => 'Future of Work',
                'has_media'  => 'no',
                'content'    => 'Tunisia Inclusive Labor Institute',
                'ar_content' => 'المعهد التونسي للعمل الشامل',
            ],
            [
                'key'        => 'pw_mena_inst_tunisia_org',
                'page'       => 'Future of Work',
                'has_media'  => 'no',
                'content'    => 'Tunisia',
                'ar_content' => 'تونس',
            ],
            [
                'key'        => 'pw_mena_inst_solidarity_name',
                'page'       => 'Future of Work',
                'has_media'  => 'no',
                'content'    => 'The Solidarity Center',
                'ar_content' => 'مركز التضامن',
            ],
            [
                'key'        => 'pw_mena_inst_solidarity_org',
                'page'       => 'Future of Work',
                'has_media'  => 'no',
                'content'    => 'Morocco',
                'ar_content' => 'المغرب',
            ],

            // ── Feminist AI ───────────────────────────────────────────────────
            [
                'key'        => 'fai_subtitle',
                'page'       => 'Feminist AI',
                'has_media'  => 'no',
                'content'    => 'Centering gender justice in artificial intelligence research, policy, and practice across the MENA region and beyond.',
                'ar_content' => 'وضع العدالة الجندرية في صميم أبحاث الذكاء الاصطناعي وسياساته وممارساته في منطقة الشرق الأوسط وشمال أفريقيا وما وراءها.',
            ],
            [
                'key'        => 'fai_about',
                'page'       => 'Feminist AI',
                'has_media'  => 'no',
                'content'    => '<p>Feminist AI is an initiative that critically examines how artificial intelligence systems interact with gender — studying biases embedded in datasets, the disproportionate impact of algorithmic decisions on women and marginalized communities, and how AI can be redesigned to advance equity.</p><p>Through the MENA Observatory on Responsible AI, we explore feminist perspectives on AI governance, ensuring that the voices of women, non-binary individuals, and underrepresented communities from the MENA region shape how AI is developed and deployed globally.</p><p>Our work is grounded in the belief that responsible AI must be feminist AI: transparent, accountable, inclusive, and oriented toward redistributing power rather than entrenching existing hierarchies.</p>',
                'ar_content' => '',
            ],
            [
                'key'        => 'fai_partnership',
                'page'       => 'Feminist AI',
                'has_media'  => 'no',
                'content'    => '<p>The MENA Observatory collaborates with the <strong>A+ Alliance for Inclusive Algorithms</strong> as part of the FAIR (Feminist AI Research) MENA initiative. This partnership brings together researchers, civil society organizations, and policy advocates to advance feminist practices in AI across the region.</p><p>FAIR MENA focuses on building regional capacity for gender-responsive AI research, creating networks of feminist AI researchers, and influencing regional and global AI governance frameworks to incorporate gender justice principles.</p>',
                'ar_content' => '',
            ],
        ];

        foreach ($items as $item) {
            static_content::firstOrCreate(
                ['key' => $item['key']],
                array_merge($item, ['width' => null, 'height' => null, 'media' => null])
            );
        }
    }
}
