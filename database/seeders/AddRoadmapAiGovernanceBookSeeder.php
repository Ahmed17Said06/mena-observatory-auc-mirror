<?php

namespace Database\Seeders;

use App\Models\Repo;
use App\Models\Repo_tags;
use App\Models\Repo_type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Adds the book "خارطة طريق نحو حوكمة فعّالة للذكاء الاصطناعي: تحليل التحديات
 * والمناهج" (A Roadmap Toward Effective AI Governance) by Judge Mohamed Fayez
 * Mohamed Hussein, Dubai Judicial Institute, as a Regional Resource in the
 * Knowledge Hub. The book is not yet on the Institute's digital store, so the
 * detail page carries a bilingual purchase note with the Institute's contact
 * link instead of a download/source URL.
 *
 * Idempotent: keyed on title. Copies the committed cover image into the public
 * disk on first run.
 *
 *   php artisan db:seed --class=AddRoadmapAiGovernanceBookSeeder --force
 */
class AddRoadmapAiGovernanceBookSeeder extends Seeder
{
    public function run(): void
    {
        $title = 'خارطة طريق نحو حوكمة فعّالة للذكاء الاصطناعي: تحليل التحديات والمناهج';

        // ── Cover image: copy the committed asset onto the public disk ────────
        $imagePath = 'books/roadmap-ai-governance-cover.jpg';
        $source    = base_path('database/seeders/assets/roadmap-ai-governance-cover.jpg');
        if (! Storage::disk('public')->exists($imagePath) && File::exists($source)) {
            Storage::disk('public')->put($imagePath, File::get($source));
        }

        // ── Bilingual purchase note (rendered as HTML on the detail page) ─────
        $contact = 'https://www.dji.gov.ae/ar/Contact-Us.aspx';
        $content = <<<HTML
<p dir="rtl" style="text-align:right;">الكتاب متاح حاليًا للشراء مباشرةً من <strong>معهد دبي القضائي</strong> عبر التواصل المباشر مع المعهد، إذ لم يُنشر بعد على المتجر الرقمي للمعهد. ويمكن في الوقت الحالي التواصل مع معهد دبي القضائي عبر الرابط التالي: <a href="{$contact}" target="_blank" rel="noopener">صفحة التواصل مع المعهد</a>.</p>
<p>The book is currently available for purchase directly from the <strong>Dubai Judicial Institute</strong> through direct communication with the Institute, as it has not yet been published on the Institute’s digital store. For the time being, the Dubai Judicial Institute may be contacted through the following link: <a href="{$contact}" target="_blank" rel="noopener">Contact the Institute</a>.</p>
<p dir="rtl" style="text-align:right;">إعداد القاضي محمد فايز محمد حسين — سلسلة الدراسات والبحوث القانونية والقضائية (٢٤) — الطبعة الأولى ١٤٤٧هـ / ٢٠٢٦م.</p>
HTML;

        $description = 'A Roadmap Toward Effective AI Governance: An Analysis of Challenges and Approaches — '
            . 'available for purchase directly from the Dubai Judicial Institute. '
            . 'متاح للشراء مباشرةً من معهد دبي القضائي.';

        $policyTypeId = Repo_type::firstOrCreate(['name' => 'Policy'])->id;

        $repo = Repo::firstOrNew(['title' => $title]);
        $repo->description  = $description;
        $repo->content      = $content;
        $repo->image        = $imagePath;
        $repo->publish_date = '2026-01-01';
        $repo->data_link    = '';          // no online source; note carries the contact link
        $repo->is_global    = false;       // Regional resource
        $repo->is_our_work  = false;
        if (empty($repo->repo_type_id)) {
            $repo->repo_type_id = $policyTypeId;
        }
        $repo->save();

        foreach (['MENA', 'AI Ethics', 'Governing Responsible AI & Data in the MENA Region'] as $name) {
            $tag = Repo_tags::firstOrCreate(['name' => $name]);
            if (! $repo->tags()->where('repo_tags.id', $tag->id)->exists()) {
                $repo->tags()->attach($tag->id);
            }
        }

        $this->command->info('Added/updated book resource #' . $repo->id . ' — ' . $title);
    }
}
