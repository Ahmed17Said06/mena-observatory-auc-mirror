<?php

namespace Database\Seeders;

use App\Models\countries;
use App\Models\News;
use Illuminate\Database\Seeder;

/**
 * Publishes the Arab Science & Technology Foundation (ASTF) press release
 * announcing the launch of the Arab Council for Law and Technology (ACLT).
 *
 * Goes to the regular News section, NOT Global AI News — an item only lands in
 * that separate grid when featured='global_ai'. Here featured='yes', which also
 * surfaces it in the homepage featured-news block.
 *
 * data_link is deliberately left null: NewsController::show() redirects away
 * when data_link is set, and this release is hosted on our own site.
 *
 * Keyed on title, so re-running is idempotent.
 *
 *     php artisan db:seed --class=Database\\Seeders\\AddAcltPressReleaseSeeder --force
 */
class AddAcltPressReleaseSeeder extends Seeder
{
    public function run(): void
    {
        $title = 'Arab Science & Technology Foundation Launches the Arab Council for Law and Technology (ACLT) from Sharjah';

        // country_id is a required FK; the release is issued from Sharjah, UAE.
        $country = countries::where('name', 'United Arab Emirates')->first()
            ?? countries::first();

        News::updateOrCreate(
            ['title' => $title],
            [
                'description' => 'The Arab Science & Technology Foundation has launched the Arab Council for Law and Technology (ACLT) from Sharjah, drawing over 300 participants from more than 25 countries.',
                'content'     => $this->content(),
                'date'        => '2026-06-29',
                'image'       => '',    // NOT NULL column; no cover image supplied
                'featured'    => 'yes', // also shows in the homepage featured-news block
                'data_link'   => null,  // keep the article on-site (no external redirect)
                'country_id'  => $country?->id,
            ]
        );

        $this->command->info('Added ACLT press release to News (featured on homepage).');
    }

    private function content(): string
    {
        return <<<'HTML'
<p><em>Shared by the MENA Observatory on Responsible AI on behalf of the Arab Science &amp; Technology Foundation (ASTF). The full statement is reproduced below in Arabic.</em></p>

<p>The Arab Science &amp; Technology Foundation (ASTF) has announced the launch of the <strong>Arab Council for Law and Technology (ACLT)</strong>, one of its specialised scientific networks, at a founding forum held from its Sharjah headquarters on Sunday, 28 June 2026. The Council responds to a growing need for an Arab space that combines legal depth with technical expertise, as artificial intelligence reshapes legislation and legal practice across the region — spanning AI governance, data governance, intellectual property and digital legislation.</p>

<p>The forum drew more than 300 participants, with 460 members registered from over 25 countries — roughly a fifth of them leaders and decision-makers across the legal and technology sectors. It was held under the patronage of His Highness Sheikh Dr. Sultan bin Muhammad Al Qasimi, Member of the Supreme Council and Ruler of Sharjah, Honorary President of the Foundation.</p>

<hr>

<div dir="rtl" lang="ar">
<p><strong>المؤسسة العربية للعلوم والتكنولوجيا — Arab Science &amp; Technology Foundation</strong></p>

<p><strong>بيان صحفي — للنشر الفوري</strong><br>
الشارقة، الإمارات العربية المتحدة — ٢٩ يونيو ٢٠٢٦</p>

<h3>العربية للعلوم والتكنولوجيا تُطلق المجلس العربي للقانون والتكنولوجيا (ACLT) من الشارقة</h3>

<p><em>ملتقى تأسيسي بحضورٍ تجاوز 300 مشارك من أكثر من 25 دولة — ومجلسٌ عربيٌّ متخصص يضع الأطر القانونية لعصر الذكاء الاصطناعي وحوكمة البيانات والملكية الفكرية</em></p>

<p>أعلنت المؤسسة العربية للعلوم والتكنولوجيا إطلاق المجلس العربي للقانون والتكنولوجيا (ACLT)، إحدى شبكاتها العلمية المتخصصة، خلال ملتقى تأسيسي عُقد افتراضياً من مقرّها بالشارقة يوم الأحد 28 يونيو 2026م. ويأتي تأسيس المجلس استجابةً للحاجة المتزايدة إلى مساحة عربية تجمع العمق القانوني بالخبرة التقنية، في ظلّ التحوّلات المتسارعة التي تفرضها تطبيقات الذكاء الاصطناعي على التشريعات والممارسات القانونية في المنطقة العربية.</p>

<p>تم تنظيم الملتقى تحت رعاية صاحب السمو الشيخ الدكتور سلطان بن محمد القاسمي، عضو المجلس الأعلى للاتحاد حاكم الشارقة، الرئيس الفخري للمؤسسة، إذ تمضي المؤسسة بكل شبكاتها وأنشطتها تحت رؤية سموّه ورعايته الكريمة، تحويلاً للطاقات العربية إلى إنجازات نوعية تعزز مكانة المنطقة على الساحة العلمية العالمية.</p>

<p>وشهد الملتقى إقبالاً لافتًا، إذ تجاوز الحضور 300 مشارك، فيما بلغ عدد المسجّلين في المجلس 460 من أكثر من 25 دولة، نحو خُمسهم من القيادات وصنّاع القرار في المجالين القانوني والتقني — من رؤساء الجامعات وعمداء الكليات، ورؤساء النقابات والجمعيات المهنية، والمديرين التنفيذيين للكيانات التقنية والقانونية، والقضاة والمستشارين الكبار، والأمناء العامّين للمراكز والمؤسسات.</p>

<p>ويمثّل المشاركون مزيجاً يجمع بين تخصّص القانون الذي شكّل أكثر من نصف الحضور، وتخصّصات العلوم والتكنولوجيا التي مثّلت نحو الثلث — بما يعكس الطابع البيني للمجلس بوصفه نقطة تقاطع عربية بين القانون والتكنولوجيا.</p>

<p>وأكّد الدكتور عبداللـه النجار الحمادي، رئيس المؤسسة العربية للعلوم والتكنولوجيا، في كلمته بعنوان «تكامل لا تنافس»، أن المجلس يأتي امتداداً لنموذج المؤسسة القائم على التكامل مع الجهود العربية القائمة لا منافستها، وقال:</p>

<blockquote>«لم نأتِ لنُزاحم مرجعيةً قائمة، بل لنبني طاولةً تتّسع للجميع؛ فالتميّز اليوم بالتكامل لا بالتنافس. وإنّ أمّةً أعطت العالمَ الخوارزمية، جديرةٌ بأن تشارك في كتابة قواعد عصرها الرقمي، لا أن تتلقّاها.»</blockquote>

<p>ومن جانبها، أوضحت الأستاذة الدكتورة رشا علي الدين، رئيسة الهيئة الإدارية للمجلس وعضو مجلس إدارة المؤسسة ورئيسة الملتقى، أن تأسيس المجلس يلبّي حاجة عربية متنامية لمتابعة الانعكاسات القانونية للتطوّرات التكنولوجية، وقالت:</p>

<blockquote>«نطمح أن يكون المجلس بيتاً لكلّ عقلٍ عربيٍّ يؤمن بأن القانون والتقنية شريكان لا خصمان؛ نحمي به الإبداع العربيّ، ونصون كرامة الإنسان في وجه الآلة. وتنوّعُ المشاركين بين القانونيين والتقنيين وصنّاع القرار خيرُ دليلٍ على الحاجة الحقيقية لهذه الشبكة.»</blockquote>

<p>يأتي تأسيس المجلس ضمن نهج المؤسسة العربية للعلوم والتكنولوجيا في حشد خبرات أعضائها وتنظيمها في شبكات متخصصة، بما يمكّن كل شبكة من الإسهام، في نطاق اختصاصها، في تحقيق أغراض المؤسسة وترسيخ رسالتها في دعم العلوم والتكنولوجيا والابتكار عربياً. وتُعد المؤسسة العربية للعلوم والتكنولوجيا أبرز المؤسسات العلمية العربية غير الحكومية وغير الربحية، إذ تأسست في الشارقة عام 2000 بموجب مرسوم أميري، تحت رعاية صاحب السمو الشيخ الدكتور سلطان بن محمد القاسمي، عضو المجلس الأعلى للاتحاد حاكم الشارقة، الرئيس الفخري للمؤسسة، وتضم أكثر من 70 ألف عضو في أكثر من 120 دولة، وتعمل بنموذج تطوعي خالص يقوم على التكامل لا التنافس مع المؤسسات والمبادرات القائمة في الوطن العربي.</p>

<h4>المتحدثون في الملتقى</h4>

<p>ضمّ الملتقى نخبة من المتحدثين العرب والدوليين الذين جمعوا بين العمق القانوني والخبرة التقنية والتطبيق العملي، وهم:</p>

<ul>
<li>أ.د. رشا علي الدين تقي الدين — رئيسة الهيئة الإدارية للمجلس وأستاذة القانون الدولي الخاص (مصر).</li>
<li>أ.د. عمار عباس الحسيني — عميد كلية القانون بجامعة المستقبل (العراق)، حول «الذكاء الاصطناعي وتحديات المسؤولية القانونية».</li>
<li>أ.د. أنس فيصل التورة — أمين عام مركز الكويت للتحكيم (الكويت)، حول «فضّ منازعات عقود التكنولوجيا في عصر الذكاء الاصطناعي».</li>
<li>أ.د. أسامة أحمد السيد بدر — أستاذ القانون المدني وعميد كلية الحقوق بجامعة طنطا الأسبق (مصر)، حول «الملكية الفكرية: حماية لعقول المبدعين».</li>
<li>د. محمد حجازي — استشاري التشريعات الرقمية والملكية الفكرية، والخبير لدى مكتب الأمم المتحدة المعني بالمخدرات والجريمة (UNODC)، حول «العدالة في عصر الخوارزميات».</li>
<li>الشيخ د. ثاني بن علي آل ثاني — نائب رئيس مجلس إدارة مركز قطر الدولي للتحكيم (قطر)، حول «القانون والتكنولوجيا: رؤية في حماية الحقوق الأساسية».</li>
<li>د. وليد أبو الحسن — عضو مجلس إدارة المؤسسة ورئيس شركة قابضة (الولايات المتحدة)، صاحب أكثر من ١٧٠ براءة اختراع دولية، حول «من فكرة بسيطة إلى شركة دولية ناجحة».</li>
<li>أ.د. عبد العزيز يسري — باحث ورائد أعمال وخبير القيادة الاستراتيجية (فرنسا)، حول «الملكية الفكرية والابتكار: نحو تحويل المعرفة العربية إلى قيمة اقتصادية مستدامة».</li>
<li>د.م. هبة الرحمن أحمد — رئيس ومؤسس نقابة المخترعين المصريين وعضو مجلس إدارة اتحاد المخترعين الأفارقة (مصر)، حول «الأطر القانونية الحاكمة لنقل الاختراعات إلى التطبيق التكنولوجي».</li>
<li>المستشار أسامة أحمد حامد — المستشار القانوني لمجلس إدارة المؤسسة، حول «أهداف المجلس العربي للقانون والتكنولوجيا وسبل تحقيقها».</li>
</ul>

<p>ويمثّل المتحدثون مصر والعراق والكويت وقطر والمغرب والإمارات إلى جانب المهجر، في مقاربةٍ عربيةٍ ودوليةٍ شاملة جمعت الرؤية الأكاديمية بالخبرة التشريعية والتطبيق العملي.</p>

<p><strong>للانضمام إلى المجلس العربي للقانون والتكنولوجيا:</strong><br>
<a href="https://docs.google.com/forms/d/e/1FAIpQLSfJwiWu4zlHWJ3jgAbRh8fgi_A6Nk6d0JVGF-rywd00C4kx4w/viewform" target="_blank" rel="noopener noreferrer">استمارة الانضمام إلى المجلس</a></p>

<p><strong>للتواصل الإعلامي:</strong> قطاع الإعلام — المؤسسة العربية للعلوم والتكنولوجيا<br>
<a href="mailto:info@astf.net">info@astf.net</a> · <a href="https://www.astf.net" target="_blank" rel="noopener noreferrer">www.astf.net</a></p>

<p>— انتهى —</p>
</div>
HTML;
    }
}
