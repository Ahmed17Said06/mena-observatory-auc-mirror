@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>
    #map_outer {
        display: none !important;
    }
    .rai-cup-content {
        color: #333;
        line-height: 1.8;
    }
    .rai-cup-content p {
        margin-bottom: 1.2rem;
        color: #333;
    }
    .rai-cup-content h3 {
        font-size: 1.3rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .rai-cup-content ul {
        margin-bottom: 1.5rem;
    }
    .rai-cup-content li {
        margin-bottom: 0.8rem;
        color: #333;
    }
    .rai-cup-content strong {
        color: var(--menablue);
    }
    .judges-list {
        list-style: none;
        padding-left: 0;
    }
    .judges-list li {
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 0.8rem;
        border-left: 4px solid var(--menaorange);
    }
    .finalists-badge {
        display: inline-block;
        background: var(--menaorange);
        color: var(--menablue);
        padding: 0.3rem 0.8rem;
        border-radius: 4px;
        font-weight: 600;
        margin: 0.2rem;
    }
    .arabic-content {
        direction: rtl;
        text-align: right;
        font-family: 'GE SS Two', 'Arial', sans-serif;
    }
    .arabic-content .judges-list li {
        border-left: none;
        border-right: 4px solid var(--menaorange);
    }
</style>
@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
    <div class="container my-3 my-lg-5">
        <div class='row'>
            <div class="col-md-10 mx-auto">
                <div class="post-loop-inner position-relative" style='background-image:url(/img/AUCLogo_BUS_A2K4D_blueCMYK_High-01 (1).png); background-size: contain; background-position: center; min-height: 300px;'>
                    <div class="post-content" lang="en">
                        <h6 style='color:#FFF;'>
                            @if(LaravelLocalization::getCurrentLocale() === 'ar')
                                كأس الذكاء الاصطناعي المسؤول 2026
                            @else
                                Responsible AI Cup Awards Ceremony 2026
                            @endif
                        </h6>
                        <p class="post-date">January 18, 2026</p>
                    </div>
                    <div class="overlay-1"></div>
                </div>
                
                <div class="d-flex flex-column flex-lg-row my-3">
                    <div class="col-12 d-flex gap-3 flex-wrap">
                        <span class="tag">Responsible AI</span>
                        <span class="tag">A2K4D</span>
                        <span class="tag">AUC</span>
                        <span class="tag">MCIT</span>
                        <span class="tag">Startups</span>
                        <span class="tag">Egypt</span>
                    </div>
                </div>
                
                @if(LaravelLocalization::getCurrentLocale() === 'ar')
                    {{-- Arabic Content --}}
                    <div class='blog-content rai-cup-content arabic-content'>
                        <h2 style="color: var(--menablue);">الجامعة الأمريكية بالقاهرة تستضيف حفل ختام كأس الذكاء الاصطناعي المسؤول تحت رعاية وزارة الاتصالات وتكنولوجيا المعلومات</h2>
                        
                        <p>سيستضيف مركز إتاحة المعرفة من أجل التنمية (A2K4D) بكلية أنسي ساويرس لإدارة الأعمال بالجامعة الأمريكية بالقاهرة حفل ختام النسخة الأولى من مسابقة كأس الذكاء الاصطناعي المسؤول يوم الأحد 18 يناير 2026 في مساحة فاوندَرْز، وسط القاهرة (وسط البلد)، تحت رعاية وزارة الاتصالات وتكنولوجيا المعلومات.</p>
                        
                        <p>ويأتي هذا الحدث ليختتم منافسات كأس الذكاء الاصطناعي المسؤول (Responsible AI Cup)، كما يتزامن مع الاحتفال بالذكرى السادسة عشر لتأسيس مركز إتاحة المعرفة من أجل التنمية (A2K4D). مسابقة كأس الذكاء الاصطناعي المسؤول هي إحدى مبادرات مرصد الشرق الأوسط وشمال أفريقيا للذكاء الاصطناعي المسؤول التابع للمركز. تهدف المسابقة إلى تعزيز السياسات والممارسات المسؤولة للذكاء الاصطناعي في المنطقة.</p>
                        
                        <p>أُطلقت مسابقة كأس الذكاء الاصطناعي المسؤول في أكتوبر 2025 باعتبارها أول مسابقة من نوعها في مصر تستهدف الشركات الصغيرة والمتوسطة والشركات الناشئة التي تقوم بتطوير أو استخدام حلول قائمة على الذكاء الاصطناعي، مع التركيز بشكل أساسي على ترسيخ مبادئ وممارسات الذكاء الاصطناعي المسؤول.</p>
                        
                        <p>شارك في المسابقة <strong>41 شركة</strong> قدمت نماذج أعمال تعكس التزامها بتطبيق الذكاء الاصطناعي المسؤول عبر تسعة محاور رئيسية، تشمل: الخصوصية، والمساءلة، والسلامة، والشفافية، والعدالة، والإشراف البشري، والمسؤولية المهنية، والقيم الإنسانية.</p>
                        
                        <h3>الفرق المتأهلة للمرحلة النهائية:</h3>
                        <p>
                            <span class="finalists-badge">Rology</span>
                            <span class="finalists-badge">Cloudilic</span>
                            <span class="finalists-badge">AgriCan</span>
                            <span class="finalists-badge">Cluster</span>
                            <span class="finalists-badge">Zaher AI</span>
                        </p>
                        
                        <p>ويحصل الفائزون بالمراكز الأول والثاني والثالث على جوائز مالية مقدمة من مركز A2K4D، فيما يحصل صاحبا المركزين الرابع والخامس على جوائز تقديرية.</p>
                        
                        <p>تهدف مسابقة كأس الذكاء الاصطناعي المسؤول إلى تحفيز الشركات الصغيرة والمتوسطة والشركات الناشئة في مصر ومنطقة الشرق الأوسط وشمال أفريقيا على تبني ممارسات الذكاء الاصطناعي المسؤول، وتسليط الضوء على النماذج التي تطبق هذه الممارسات بالفعل.</p>
                        
                        <p>ويجمع الحفل نخبة من رواد منظومة الشركات الناشئة في مجال الذكاء الاصطناعي، إلى جانب لجنة من الخبراء والمحكّمين، وممثلين مدعوين من مرصد الشرق الأوسط وشمال أفريقيا للذكاء الاصطناعي المسؤول.</p>
                        
                        <h3>لجنة التحكيم النهائية:</h3>
                        <ul class="judges-list">
                            <li><strong>د.هدى بركة</strong> - مستشار وزير الاتصالات وتكنولوجيا المعلومات وأستاذ هندسة الحاسبات، جامعة القاهرة</li>
                            <li><strong>د. نزار سامي</strong> - محلل تنمية المهارات، البرنامج الإقليمي للدول العربية (RBAS)، برنامج الأمم المتحدة الإنمائي (UNDP)</li>
                            <li><strong>د. أيمن إسماعيل</strong> - أستاذ كرسي عبد اللطيف جميل لريادة الأعمال بكلية أنسي ساويرس لإدارة الأعمال بالجامعة الأميركية بالقاهرة</li>
                            <li><strong>م. لمياء الرشيدي</strong> - مدير إدارة الحاضنات بمركز الإبداع وريادة الأعمال</li>
                        </ul>
                        
                        <p>ويعكس هذا الحدث التزام الجامعة الأمريكية بالقاهرة وبرنامج A2K4D بدعم الابتكار المسؤول في مجال الذكاء الاصطناعي، وتعزيز الحلول التقنية التي تخدم المجتمع وتدعم التنمية الشاملة والمستدامة.</p>
                    </div>
                @else
                    {{-- English Content --}}
                    <div class='blog-content rai-cup-content'>
                        <h2 style="color: var(--menablue);">The Access to Knowledge for Development Center at The American University in Cairo Hosts the Responsible AI Cup Awards Ceremony Under the Patronage of the Ministry of Communications and Information Technology (MCIT)</h2>
                        
                        <p>The American University in Cairo (AUC) represented by Access to Knowledge for Development (A2K4D) at Onsi Sawiris School of Business will host the Inaugural Responsible AI Cup Awards Ceremony on Sunday, January 18, 2026, at Founders Spaces, Downtown Cairo. The event is held under the patronage of the Ministry of Communications and Information Technology (MCIT) and marks the conclusion of the Responsible AI (RAI) Cup competition, while also celebrating the 16th anniversary of Access to Knowledge for Development (A2K4D) Center.</p>
                        
                        <p>The RAI competition is an initiative of A2K4D's flagship MENA Observatory on Responsible AI, advocating for responsible AI policies and practices across the MENA region.</p>
                        
                        <p>The RAI Cup competition was launched in October 2025 as the first competition in Egypt for Small and Medium Enterprises (SMEs) and startups building or using artificial intelligence (AI) in their tech solutions, with a primary focus on fostering responsible AI themes and practices.</p>
                        
                        <p>The competition brought together submissions from <strong>41 companies</strong> demonstrating their commitment to responsible AI across nine pillars: privacy, accountability, safety, transparency, fairness, human oversight, professional responsibility and human values.</p>
                        
                        <h3>Finalists Selected for the Awards Ceremony:</h3>
                        <p>
                            <span class="finalists-badge">Rology</span>
                            <span class="finalists-badge">Cloudilic</span>
                            <span class="finalists-badge">AgriCan</span>
                            <span class="finalists-badge">Cluster</span>
                            <span class="finalists-badge">Zaher AI</span>
                        </p>
                        
                        <p>The first, second and third places will receive financial awards from A2K4D, and the fourth and fifth places will receive honorary awards.</p>
                        
                        <p>The RAI Cup aims at incentivizing SMEs and startups in Egypt and the MENA region, to implement responsible AI and recognize responsible practices that are already in place. It also seeks to raise awareness about ethical, legal and environmental implications of AI. The RAI Cup provides a space for entrepreneurs to collaborate with each other, as well as with experts from academia and the AI ecosystem.</p>
                        
                        <p>Grounded in capacity building, the RAI Cup competition gave participants the opportunity to grow their skills through educational content and training in responsible AI.</p>
                        
                        <p>The ceremony will bring together prominent figures from the AI startup ecosystem, experienced judges and invited guests from the MENA Observatory on Responsible AI, alongside members of A2K4D's regional and international networks.</p>
                        
                        <p>The program will feature finalist pitches from the Responsible AI Cup, followed by the announcement of award recipients in recognition of exceptional approaches to responsible AI. The event will also include an engaging discussion on responsible AI and conclude with a reflection on A2K4D's achievements and impact in 2025.</p>
                        
                        <h3>The Panel of Judges for the Final Pitches:</h3>
                        <ul class="judges-list">
                            <li><strong>Hoda Baraka</strong> - Advisor to Minister of Communications and Information Technology and professor of computer engineering, Cairo University</li>
                            <li><strong>Nezar Sami</strong> - Skills development analyst, Regional Programme for Arab States (RBAS), Regional Programme Division, United Nations Development Programme UNDP</li>
                            <li><strong>Ayman Ismail</strong> - Abdul Latif Jameel Endowed Chair of Entrepreneurship, associate professor, Onsi Sawiris School of Business, and founding director of AUC Venture Lab, The American University in Cairo</li>
                            <li><strong>Lamiaa El Rashidi</strong> - Senior manager, Incubation Department, Technology Innovation and Entrepreneurship Center (TIEC)</li>
                        </ul>
                        
                        <p>By convening key stakeholders from academia, government and the private sector, the Responsible AI Cup Awards Ceremony underscores AUC's and A2K4D's commitment to advancing responsible AI practices and supporting innovation that aligns with societal values and inclusive development.</p>
                    </div>
                @endif
                
                <div class="mt-4">
                    <a href="{{ route('news.index') }}" class="btn btn-mena-4">← @lang('translation.back-to-news', ['default' => 'Back to News'])</a>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.guest.footer')
@endsection