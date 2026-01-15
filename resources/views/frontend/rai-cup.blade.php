@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', LaravelLocalization::getCurrentLocale() === 'ar' ? 'حفل ختام كأس الذكاء الاصطناعي المسؤول' : 'Responsible AI Cup Awards Ceremony')

@section('content')
@include('layouts.navbars.guest.navbar', ['title' => 'RAI Cup'])

<style>
    .rai-cup-hero {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        padding: 80px 0;
        color: #fff;
    }
    .rai-cup-content {
        padding: 60px 0;
        color: #333;
    }
    .rai-cup-content p {
        color: #333 !important;
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }
    .rai-cup-content h2 {
        color: #1a1a2e;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .judges-list {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 12px;
        margin: 30px 0;
    }
    .judges-list h3 {
        color: #1a1a2e !important;
    }
    .judges-list ul {
        list-style: none;
        padding: 0;
    }
    .judges-list li {
        padding: 15px 0;
        border-bottom: 1px solid #e9ecef;
        color: #333 !important;
    }
    .judges-list li:last-child {
        border-bottom: none;
    }
    .event-details {
        background: linear-gradient(135deg, #FAAF1C 0%, #e89d0f 100%);
        padding: 30px;
        border-radius: 12px;
        margin: 30px 0;
        color: #1a1a2e;
    }
    .finalists-box {
        background: #1a1a2e;
        padding: 30px;
        border-radius: 12px;
        margin: 30px 0;
    }
    .finalists-box h3 {
        color: #FAAF1C !important;
    }
    .finalists-box p {
        color: #ffffff !important;
    }
</style>

<div class="rai-cup-hero">
    <div class="container text-center">
        <h1 class="mb-4" style="font-size: 2.5rem;">
            @if(LaravelLocalization::getCurrentLocale() === 'ar')
                حفل ختام كأس الذكاء الاصطناعي المسؤول
            @else
                Responsible AI Cup Awards Ceremony
            @endif
        </h1>
        <p class="lead" style="opacity: 0.9; color: #fff !important;">
            @if(LaravelLocalization::getCurrentLocale() === 'ar')
                تحت رعاية وزارة الاتصالات وتكنولوجيا المعلومات
            @else
                Under the Patronage of the Ministry of Communications and Information Technology (MCIT)
            @endif
        </p>
    </div>
</div>

<div class="rai-cup-content">
    <div class="container" @if(LaravelLocalization::getCurrentLocale() === 'ar') dir="rtl" @endif>
        
        <div class="event-details">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3><i class="fas fa-calendar-alt me-2"></i> 
                        @if(LaravelLocalization::getCurrentLocale() === 'ar')
                            الأحد 18 يناير 2026
                        @else
                            Sunday, January 18, 2026
                        @endif
                    </h3>
                </div>
                <div class="col-md-6">
                    <h3><i class="fas fa-map-marker-alt me-2"></i> 
                        @if(LaravelLocalization::getCurrentLocale() === 'ar')
                            مساحة فاوندَرْز، وسط القاهرة
                        @else
                            Founders Spaces, Downtown Cairo
                        @endif
                    </h3>
                </div>
            </div>
        </div>

        @if(LaravelLocalization::getCurrentLocale() === 'ar')
            <p>سيستضيف مركز إتاحة المعرفة من أجل التنمية (A2K4D) بكلية أنسي ساويرس لإدارة الأعمال بالجامعة الأمريكية بالقاهرة حفل ختام النسخة الأولى من مسابقة كأس الذكاء الاصطناعي المسؤول يوم الأحد 18 يناير 2026 في مساحة فاوندَرْز، وسط القاهرة (وسط البلد)، تحت رعاية وزارة الاتصالات وتكنولوجيا المعلومات. ويأتي هذا الحدث ليختتم منافسات كأس الذكاء الاصطناعي المسؤول (Responsible AI Cup)، كما يتزامن مع الاحتفال بالذكرى السادسة عشر لتأسيس مركز إتاحة المعرفة من أجل التنمية (A2K4D). مسابقة كأس الذكاء الاصطناعي المسؤول هي إحدى مبادرات مرصد الشرق الأوسط وشمال أفريقيا للذكاء الاصطناعي المسؤول التابع للمركز. تهدف المسابقة إلى تعزيز السياسات والممارسات المسؤولة للذكاء الاصطناعي في المنطقة.</p>

            <p>أُطلقت مسابقة كأس الذكاء الاصطناعي المسؤول في أكتوبر 2025 باعتبارها أول مسابقة من نوعها في مصر تستهدف الشركات الصغيرة والمتوسطة والشركات الناشئة التي تقوم بتطوير أو استخدام حلول قائمة على الذكاء الاصطناعي، مع التركيز بشكل أساسي على ترسيخ مبادئ وممارسات الذكاء الاصطناعي المسؤول. شارك في المسابقة 41 شركة قدمت نماذج أعمال تعكس التزامها بتطبيق الذكاء الاصطناعي المسؤول عبر تسعة محاور رئيسية، تشمل: الخصوصية، والمساءلة، والسلامة، والشفافية، والعدالة، والإشراف البشري، والمسؤولية المهنية، والقيم الإنسانية.</p>

            <div class="finalists-box">
                <h3>الفرق المتأهلة للمرحلة النهائية</h3>
                <p>Rology، Cloudilic، AgriCan، Cluster، وZaher AI</p>
                <p>ويحصل الفائزون بالمراكز الأول والثاني والثالث على جوائز مالية مقدمة من مركز A2K4D، فيما يحصل صاحبا المركزين الرابع والخامس على جوائز تقديرية.</p>
            </div>

            <p>تهدف مسابقة كأس الذكاء الاصطناعي المسؤول إلى تحفيز الشركات الصغيرة والمتوسطة والشركات الناشئة في مصر ومنطقة الشرق الأوسط وشمال أفريقيا على تبني ممارسات الذكاء الاصطناعي المسؤول، وتسليط الضوء على النماذج التي تطبق هذه الممارسات بالفعل. كما تسعى إلى رفع الوعي بالتداعيات الأخلاقية والقانونية والبيئية المرتبطة باستخدام الذكاء الاصطناعي. وتوفر المسابقة منصة تعاونية تركز على بناء القدرات المشاركين من خلال محتوى تعليمي وتدريبات متخصصة في الذكاء الاصطناعي المسؤول.</p>

            <p>ويجمع الحفل نخبة من رواد منظومة الشركات الناشئة في مجال الذكاء الاصطناعي، إلى جانب لجنة من الخبراء والمحكّمين، وممثلين مدعوين من مرصد الشرق الأوسط وشمال أفريقيا للذكاء الاصطناعي المسؤول، إضافة إلى شركاء وشبكات A2K4D الإقليمية والدولية. ويهدف الحدث إلى تسليط الضوء على الابتكارات التي تعزز الاستخدام الأخلاقي والمسؤول للذكاء الاصطناعي، وفتح باب الحوار بين صناع السياسات والممارسين والمبتكرين.</p>

            <p>يتضمن برنامج الحفل العروض النهائية للفرق المتأهلة في كأس الذكاء الاصطناعي المسؤول، يليها الإعلان عن الجهات الحاصلة على الجوائز تقديرًا لما قدمته من نماذج متميزة في مجال الذكاء الاصطناعي المسؤول. كما يشمل الحدث جلسة نقاشية تفاعلية حول مستقبل الذكاء الاصطناعي المسؤول، ويُختتم باستعراض أبرز إنجازات برنامج إتاحة المعرفة من أجل التنمية (A2K4D) وتأثيره خلال عام 2025.</p>

            <div class="judges-list">
                <h3>لجنة التحكيم النهائية</h3>
                <ul>
                    <li><strong>د.هدى بركة</strong> - مستشار وزير الاتصالات وتكنولوجيا المعلومات وأستاذ هندسة الحاسبات، جامعة القاهرة</li>
                    <li><strong>د. نزار سامي</strong> - خبير تنمية المهارات، البرنامج الإقليمي للدول العربية (RBAS)، إدارة البرامج الإقليمية، برنامج الأمم المتحدة الإنمائي (UNDP)</li>
                    <li><strong>د. أيمن إسماعيل</strong> - مدرس وأستاذ كرسي عبد اللطيف جميل لريادة الأعمال بكلية أنسي ساويرس لإدارة الأعمال بالجامعة الأميركية بالقاهرة</li>
                    <li><strong>م. لمياء الرشيدي</strong> - مدير إدارة الحاضنات بمركز الإبداع وريادة الأعمال</li>
                </ul>
            </div>

            <p>ويعكس هذا الحدث التزام الجامعة الأمريكية بالقاهرة وبرنامج A2K4D بدعم الابتكار المسؤول في مجال الذكاء الاصطناعي، وتعزيز الحلول التقنية التي تخدم المجتمع وتدعم التنمية الشاملة والمستدامة.</p>

        @else
            <p>The American University in Cairo (AUC) represented by Access to Knowledge for Development (A2K4D) at Onsi Sawiris School of Business will host the Inaugural Responsible AI Cup Awards Ceremony on Sunday, January 18, 2026, at Founders Spaces, Downtown Cairo. The event is held under the patronage of the Ministry of Communications and Information Technology (MCIT) and marks the conclusion of the Responsible AI (RAI) Cup competition, while also celebrating the 16th anniversary of Access to Knowledge for Development (A2K4D) Center. The RAI competition is an initiative of A2K4D's flagship MENA Observatory on Responsible AI, advocating for responsible AI policies and practices across the MENA region.</p>

            <p>The RAI Cup competition was launched in October 2025 as the first competition in Egypt for Small and Medium Enterprises (SMEs) and startups building or using artificial intelligence (AI) in their tech solutions, with a primary focus on fostering responsible AI themes and practices. The competition brought together submissions from 41 companies demonstrating their commitment to responsible AI across nine pillars: privacy, accountability, safety, transparency, fairness, human oversight, professional responsibility and human values. The submissions were then evaluated and the top five participants were selected to showcase their pitches on the upcoming awards ceremony day.</p>

            <div class="finalists-box">
                <h3>Finalists</h3>
                <p>Rology, Cloudilic, AgriCan, Cluster and Zaher AI</p>
                <p>The first, second and third places will receive financial awards from A2K4D, and the fourth and fifth places will receive honorary awards.</p>
            </div>

            <p>The RAI Cup aims at incentivizing SMEs and startups in Egypt and the MENA region, to implement responsible AI and recognize responsible practices that are already in place. It also seeks to raise awareness about ethical, legal and environmental implications of AI. The RAI Cup provides a space for entrepreneurs to collaborate with each other, as well as with experts from academia and the AI ecosystem. Grounded in capacity building, the RAI Cup competition gave participants the opportunity to grow their skills through educational content and training in responsible AI.</p>

            <p>The ceremony will bring together prominent figures from the AI startup ecosystem, experienced judges and invited guests from the MENA Observatory on Responsible AI, alongside members of A2K4D's regional and international networks. The event aims to highlight innovative approaches to responsible and ethical artificial intelligence while fostering dialogue among policymakers, practitioners and innovators.</p>

            <p>The program will feature finalist pitches from the Responsible AI Cup, followed by the announcement of award recipients in recognition of exceptional approaches to responsible AI. The event will also include an engaging discussion on responsible AI and conclude with a reflection on A2K4D's achievements and impact in 2025.</p>

            <div class="judges-list">
                <h3>Panel of Judges</h3>
                <ul>
                    <li><strong>Hoda Baraka</strong> - Advisor to Minister of Communications and Information Technology and professor of computer engineering, Cairo University</li>
                    <li><strong>Nezar Sami</strong> - Skills development analyst, Regional Programme for Arab States (RBAS), Regional Programme Division, United Nations Development Programme UNDP</li>
                    <li><strong>Ayman Ismail</strong> - Abdul Latif Jameel Endowed Chair of Entrepreneurship, associate professor, Onsi Sawiris School of Business, and founding director of AUC Venture Lab, The American University in Cairo</li>
                    <li><strong>Lamiaa El Rashidi</strong> - Senior manager, Incubation Department, Technology Innovation and Entrepreneurship Center (TIEC)</li>
                </ul>
            </div>

            <p>By convening key stakeholders from academia, government and the private sector, the Responsible AI Cup Awards Ceremony underscores AUC's and A2K4D's commitment to advancing responsible AI practices and supporting innovation that aligns with societal values and inclusive development.</p>
        @endif

    </div>
</div>

@include('layouts.footers.guest.footer')
@endsection