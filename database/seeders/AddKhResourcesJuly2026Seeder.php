<?php

namespace Database\Seeders;

use App\Models\Repo;
use App\Models\Repo_tags;
use App\Models\Repo_type;
use Illuminate\Database\Seeder;

/**
 * Adds the July 2026 batch of external Knowledge Hub resources.
 *
 * Section routing (see App\Http\Livewire\RepoList):
 *   Global Resources   => is_our_work = false, is_global = true
 *   Regional Resources => is_our_work = false, is_global = false
 * NOTE: repo.is_our_work defaults to 1 in the schema, so it must be set to
 * false explicitly or the row would land in "Observatory Outputs".
 *
 * Keyed on data_link, so re-running is idempotent. The cover image is only set
 * on insert — never on update — so a cover fetched later by `repos:fetch-covers`
 * is not clobbered by a re-run.
 *
 *     php artisan db:seed --class=Database\\Seeders\\AddKhResourcesJuly2026Seeder --force
 *     php artisan repos:fetch-covers      # then generate covers for these
 */
class AddKhResourcesJuly2026Seeder extends Seeder
{
    public function run(): void
    {
        $report = $this->typeId('Report');
        $policy = $this->typeId('Policy');

        // [title, description, link, type, tags, date?]
        $global = [
            [
                'title' => 'Encyclical Letter, Magnifica Humanitas: On Safeguarding the Human Person in the Time of AI',
                'desc'  => 'Encyclical letter of Pope Leo XIV on safeguarding human dignity and the human person in the age of artificial intelligence. (The Holy See)',
                'link'  => 'https://www.vatican.va/content/leo-xiv/en/encyclicals/documents/20260515-magnifica-humanitas.html',
                'type'  => $report,
                'date'  => '2026-05-15',
                'tags'  => ['Artificial Intelligence', 'AI Ethics', 'Responsible AI'],
            ],
            [
                'title' => 'Advancing Food Security through Smart Farming: A Systematic Review',
                'desc'  => 'A systematic review of how smart-farming technologies and artificial intelligence are being applied to strengthen food security. (IOP Conference Series: Earth and Environmental Science)',
                'link'  => 'https://iopscience.iop.org/article/10.1088/1755-1315/1584/1/012029/pdf',
                'type'  => $report,
                'tags'  => ['Artificial Intelligence', 'Sustainable Development', 'Environment'],
            ],
            [
                'title' => 'AI and Smart Water Treatment: A Bibliometric Perspective',
                'desc'  => 'A bibliometric analysis of the research landscape on artificial intelligence applications in smart water treatment.',
                'link'  => 'https://journals.ekb.eg/article_448866_1b7f478f48121bc30aad8543c2d38f43.pdf',
                'type'  => $report,
                'tags'  => ['Artificial Intelligence', 'Environment', 'Sustainable Development'],
            ],
            [
                'title' => 'AI for Sustainability and Ecological Resilience in Urban Planning',
                'desc'  => 'Examines the use of artificial intelligence to advance sustainability and ecological resilience in urban planning. (SSRN working paper)',
                // Canonical SSRN URL — the supplied link carried an ephemeral
                // Cloudflare challenge token that would expire and break.
                'link'  => 'https://papers.ssrn.com/sol3/papers.cfm?abstract_id=6875718',
                'type'  => $report,
                'tags'  => ['Artificial Intelligence', 'Urban Development', 'Sustainable Development'],
            ],
            [
                'title' => 'Impact of AI on Democracy, Human Rights and the Rule of Law',
                'desc'  => 'A study of the implications of artificial intelligence for democratic institutions, human rights and the rule of law. (ALLAI)',
                'link'  => 'https://allai.nl/wp-content/uploads/2020/06/The-Impact-of-AI-on-Human-Rights-Democracy-and-the-Rule-of-Law-draft.pdf',
                'type'  => $report,
                'tags'  => ['Artificial Intelligence', 'AI Ethics', 'Policy'],
            ],
            [
                'title' => 'Learners in the Age of AI',
                'desc'  => 'Research on how learners and education systems are adapting to artificial intelligence. (EdTech Hub)',
                'link'  => 'https://docs.edtechhub.org/lib/M5E9SEKI/download/FSIDNPBU',
                'type'  => $report,
                'tags'  => ['Artificial Intelligence', 'Education'],
            ],
        ];

        $regional = [
            [
                'title' => 'AI and the MENA Workforce: Translating Digital Transformation into Human Transformation',
                'desc'  => 'Examines how artificial intelligence and digital transformation are reshaping the workforce across the MENA region.',
                'link'  => 'https://www.researchgate.net/publication/395939243_AI_and_the_MENA_Workforce_Translating_Digital_Transformation_into_Human_Transformation',
                'type'  => $report,
                'tags'  => ['Artificial Intelligence', 'MENA', 'fow'],
            ],
            [
                'title' => 'Egypt: Artificial Intelligence Readiness Assessment Report',
                'desc'  => "UNESCO's assessment of Egypt's readiness to adopt and govern artificial intelligence, benchmarked against the Recommendation on the Ethics of AI.",
                'link'  => 'https://unesdoc.unesco.org/ark:/48223/pf0000395173',
                'type'  => $report,
                'tags'  => ['Artificial Intelligence', 'MENA', 'Egypt', 'National Policies'],
            ],
            [
                'title' => 'Saudi Arabia: Artificial Intelligence Readiness Assessment Report',
                'desc'  => "UNESCO's assessment of Saudi Arabia's readiness to adopt and govern artificial intelligence, benchmarked against the Recommendation on the Ethics of AI.",
                'link'  => 'https://unesdoc.unesco.org/ark:/48223/pf0000392184',
                'type'  => $report,
                'tags'  => ['Artificial Intelligence', 'MENA', 'National Policies'],
            ],
            [
                'title' => 'AI and Healthcare in the MENA Region',
                'desc'  => 'Report on the adoption, opportunities and risks of artificial intelligence in healthcare across the MENA region. (FII Institute)',
                'link'  => 'https://fii-institute.org/wp-content/uploads/2025/10/AIANDH1-1.pdf',
                'type'  => $report,
                'date'  => '2025-10-01',
                'tags'  => ['Artificial Intelligence', 'MENA', 'Health'],
            ],
            [
                'title' => 'AI-Enabled Misconduct and Corporate Criminal Liability in Arab Jurisdictions',
                'desc'  => 'Analyses offence design, evidence and cross-border enforcement for AI-enabled corporate misconduct across Arab jurisdictions.',
                'link'  => 'https://virtusinterpress.org/AI-enabled-misconduct-and-corporate-criminal-liability-in-Arab-jurisdictions-Offence-design-evidence-and-cross-border-enforcement.html',
                'type'  => $report,
                'tags'  => ['Artificial Intelligence', 'MENA', 'Policy'],
            ],
            [
                'title' => 'The Arab Middle Class in an Age of Disruption: Trade Fragmentation and AI in the MENA Region',
                'desc'  => 'Examines how trade fragmentation and artificial intelligence are reshaping the Arab middle class across the MENA region.',
                'link'  => 'https://futureuae.com/en-US/Mainpage/Item/11027/the-arab-middle-class-in-an-age-of-disruption-trade-fragmentation-and-artificial-intelligence-in-the-mena-region',
                'type'  => $report,
                'tags'  => ['Artificial Intelligence', 'MENA', 'Economy'],
            ],
            [
                'title' => 'New Evidence on the Geopolitical Risk–Carbon Emissions Nexus in Selected MENA Countries',
                'desc'  => 'Empirical study of the relationship between geopolitical risk and carbon emissions across selected MENA countries.',
                'link'  => 'https://journals.ekb.eg/article_501801.html',
                'type'  => $report,
                'tags'  => ['MENA', 'Environment', 'Economy'],
            ],
            [
                'title' => 'Artificial Intelligence Enhanced Credit Scoring for MSMEs: A Policy Framework',
                'desc'  => 'Proposes a policy framework for AI-enhanced credit scoring to widen access to finance for micro, small and medium enterprises.',
                'link'  => 'http://ecsdev.org/ojs/index.php/ejsd/article/view/2010',
                'type'  => $policy,
                'tags'  => ['Artificial Intelligence', 'Economy', 'Policy'],
            ],
            [
                'title' => 'AI-Driven Semantic Information Retrieval for Arabic Language: A Systematic Literature Review',
                'desc'  => 'A systematic literature review of AI-driven semantic information retrieval for the Arabic language.',
                'link'  => 'https://www.sciencedirect.com/science/article/pii/S1574013726000298',
                'type'  => $report,
                'tags'  => ['Artificial Intelligence', 'MENA', 'Information Technology'],
            ],
            [
                'title' => 'AI-Driven Sustainability and Cultural Shifts in Egyptian Organizations',
                'desc'  => 'Studies how the adoption of artificial intelligence is driving sustainability practices and cultural change in Egyptian organizations.',
                'link'  => 'https://journals.ekb.eg/article_501649_21056796a146d170989105534d44bee6.pdf',
                'type'  => $report,
                'tags'  => ['Artificial Intelligence', 'Egypt', 'Sustainable Development'],
            ],
            [
                'title' => 'AI Integration in Education in the MENA Region: Will It Be a Driver of Social Inequality?',
                'desc'  => 'Asks whether integrating artificial intelligence into education across the MENA region risks deepening social inequality.',
                'link'  => 'https://repository.gchumanrights.org/server/api/core/bitstreams/d3c58797-06ec-469e-bf66-d07490a34f07/content',
                'type'  => $report,
                'tags'  => ['Artificial Intelligence', 'MENA', 'Education', 'Digital Inequalities'],
            ],
        ];

        $created = 0;
        $updated = 0;

        foreach ([['global' => true, 'rows' => $global], ['global' => false, 'rows' => $regional]] as $set) {
            foreach ($set['rows'] as $r) {
                $repo = Repo::firstOrNew(['data_link' => $r['link']]);
                $isNew = ! $repo->exists;

                $repo->title        = $r['title'];
                $repo->description  = $r['desc'];
                $repo->is_our_work  = false;          // schema defaults to 1 — must be explicit
                $repo->is_global    = $set['global'];
                $repo->repo_type_id = $r['type'];

                if (! empty($r['date'])) {
                    $repo->publish_date = $r['date'];
                }

                // image is NOT NULL. Set it only on insert so a cover generated
                // later by repos:fetch-covers survives a re-run of this seeder.
                if ($isNew) {
                    $repo->image = '';
                }

                $repo->save();

                $tagIds = Repo_tags::whereIn('name', $r['tags'])->pluck('id')->all();
                if ($tagIds) {
                    $repo->tags()->syncWithoutDetaching($tagIds);
                }

                $isNew ? $created++ : $updated++;
                $this->command->line('  ' . ($isNew ? 'created' : 'updated') . ' [' . ($set['global'] ? 'global' : 'regional') . '] ' . $r['title']);
            }
        }

        $this->command->newLine();
        $this->command->info("Knowledge Hub resources — created: {$created}  |  updated: {$updated}");
        $this->command->comment('Next: php artisan repos:fetch-covers   (to generate cover images)');
    }

    private function typeId(string $name): ?string
    {
        $type = Repo_type::where('name', $name)->first();

        return $type ? (string) $type->id : null;
    }
}
