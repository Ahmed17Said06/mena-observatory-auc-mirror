<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Repo;
use App\Models\Repo_tags;
use App\Models\Repo_type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Imports "Research and News.xlsx":
 *   - News sheet   → News records flagged featured='global_ai' (Global AI News
 *                    section on the news page; also appear in the main list).
 *   - Regional sheet → Repo records (is_global=false) — Regional Resources.
 *   - Global sheet   → Repo records (is_global=true)  — Global Resources.
 *
 * Idempotent: keyed on title. Existing repos get repo_type_id / is_global
 * backfilled. repo_type is auto-derived: a "Blog Post" tag → Blogpost;
 * Charter/Policy/Brief/Roadmap → Policy; otherwise Report.
 */
class ResearchAndNewsImportSeeder extends Seeder
{
    public function run(): void
    {
        $this->importNews();
        $this->importRepos($this->regional(), false);
        $this->importRepos($this->global(), true);
    }

    private function importNews(): void
    {
        foreach ($this->news() as $n) {
            $news = News::firstOrNew(['title' => $n['title']]);
            $news->featured  = 'global_ai';
            $news->date      = $n['date'] ?: null;
            $news->data_link = $n['data_link'];
            $news->description = 'Source: ' . $n['source'];
            if (!$news->exists) {
                $news->content = '';
                $news->image   = '';
            }
            $news->save();
        }
    }

    private function importRepos(array $rows, bool $isGlobal): void
    {
        foreach ($rows as $r) {
            $typeId = $this->typeIdFor($r['tags'], $r['title']);

            $repo = Repo::firstOrNew(['title' => $r['title']]);
            $repo->description  = $r['institution'];
            $repo->publish_date = $r['publish_date'] ?: null;
            $repo->data_link    = $r['data_link'];
            $repo->is_global    = $isGlobal;
            $repo->is_our_work  = false;
            if (!$repo->exists) {
                $repo->image = '';
            }
            if (empty($repo->repo_type_id)) {
                $repo->repo_type_id = $typeId;
            }
            $repo->save();

            foreach ($r['tags'] as $name) {
                $tag = Repo_tags::firstOrCreate(['name' => $name]);
                if (!$repo->tags()->where('repo_tags.id', $tag->id)->exists()) {
                    $repo->tags()->attach($tag->id);
                }
            }
        }
    }

    /** Resolve the repo_type id for the given tags/title (auto-categorisation). */
    private function typeIdFor(array $tags, string $title): int
    {
        $lowerTags = array_map('strtolower', $tags);

        if (in_array('blog post', $lowerTags, true)) {
            $name = 'Blogpost';
        } elseif (in_array('policy', $lowerTags, true)
            || Str::contains(Str::lower($title), ['charter', 'policy', 'brief', 'roadmap'])) {
            $name = 'Policy';
        } else {
            $name = 'Report';
        }

        return Repo_type::firstOrCreate(['name' => $name])->id;
    }

    private function news(): array
    {
        return [
            ['title' => 'Government Meeting: Review Of The Draft National Artificial Intelligence Strategy', 'source' => 'Algeriaan Radio Multimedia', 'date' => '2026-05-25', 'data_link' => 'https://news.radioalgerie.dz/en/node/86938'],
            ['title' => 'Arab women\'s voices \'must be heard\' in AI revolution', 'source' => 'The National', 'date' => '2026-05-27', 'data_link' => 'https://www.thenationalnews.com/news/uk/2026/05/27/plea-for-arab-womens-voices-to-be-heard-in-ai-revolution/'],
            ['title' => 'NVIDIA AI Cloud Ecosystem Expands Worldwide to Meet Global AI Compute Demand', 'source' => 'Nvidia', 'date' => '2026-05-31', 'data_link' => 'https://blogs.nvidia.com/blog/ai-cloud-ecosystem/'],
            ['title' => 'AI’s environmental costs threaten water, land and climate', 'source' => 'UN', 'date' => '2026-04-06', 'data_link' => 'https://news.un.org/en/story/2025/07/1165306'],
            ['title' => 'Microsoft reports are exposing AI’s real cost problem: Using the tech is more expensive than paying human employees', 'source' => 'Forbes', 'date' => '2026-05-22', 'data_link' => 'https://fortune.com/2026/05/22/microsoft-ai-cost-problem-tokens-agents/'],
            ['title' => 'Startup Wrap: More than $69m flows into MENA startups', 'source' => 'Arab News', 'date' => '2026-06-20', 'data_link' => 'https://www.arabnews.com/node/2647977/business-economy'],
            ['title' => 'Guiding our AI deployment with a set of employee councils', 'source' => 'Microsoft', 'date' => '2026-06-18', 'data_link' => 'https://www.microsoft.com/insidetrack/blog/guiding-our-ai-deployment-with-a-set-of-employee-councils/'],
            ['title' => 'Media practitioners, regulators rally for responsible AI adoption', 'source' => 'Radio Tamazuj', 'date' => '2026-03-06', 'data_link' => 'https://www.radiotamazuj.org/en/news/article/media-practitioners-regulators-rally-for-responsible-ai-adoption'],
            ['title' => 'Retail Asia Summit 2026 in Singapore to highlight responsible AI, unified data, and retail innovation', 'source' => 'Retail Asia', 'date' => '2026-06-18', 'data_link' => 'https://retailasia.com/event-news/retail-asia-summit-2026-in-singapore-highlight-responsible-ai-unified-data-and-retail-innovation'],
            ['title' => 'IBA launches Artificial Intelligence Institute to focus on responsible AI governance', 'source' => 'The Global Legal Post', 'date' => '2026-11-06', 'data_link' => 'https://www.globallegalpost.com/news/iba-launches-artificial-intelligence-institute-to-focus-on-responsible-ai-governance-869660210'],
        ];
    }

    private function regional(): array
    {
        return [
            ['title' => 'AI and the MENA Workforce: Translating Digital Transformation into Human Transformation', 'institution' => 'Journal of Business Theory and Practice', 'publish_date' => '2025-09-28', 'data_link' => 'https://dx.doi.org/10.22158/jbtp.v13n2p87', 'tags' => ['MENA', 'Responsible AI', 'Economy', 'Human Resources']],
            ['title' => 'ALECSO Charter on Artificial Intelligence Ethics', 'institution' => 'Arab League Educational, Cultural and Scientific Organization', 'publish_date' => '2025-06-01', 'data_link' => 'https://www.alecso.org/publications/uploads/2025/08/etic.pdf', 'tags' => ['AI Ethics', 'MENA']],
            ['title' => 'Artificial Intelligence Futures for the Arab Region', 'institution' => 'UNESCWA', 'publish_date' => '2025-06-01', 'data_link' => 'https://www.unescwa.org/sites/default/files/pubs/pdf/artificial-intelligence-futures-arab-region-english.pdf', 'tags' => ['Sustainable Development', 'AI Technology', 'MENA']],
            ['title' => 'Artificial Intelligence (AI) and Employment in the Arab Countries', 'institution' => 'Annual Conference of the Arab Society for Economic Research', 'publish_date' => '2024-09-15', 'data_link' => 'https://www.asfer.org/001/wp-content/uploads/2024/12/“Artificial-Intelligence-AI-and-Employment-in-the-Arab-Countries”.pdf', 'tags' => ['Economy']],
            ['title' => 'Artificial Intelligence and Employment Futures for the Arab Region', 'institution' => 'International Labour Organization', 'publish_date' => '2026-05-21', 'data_link' => 'https://www.ilo.org/sites/default/files/2026-05/2500858E_AI-and-Employment-Futures-for-the-Arab-Region-E-final.pdf', 'tags' => ['Economy']],
            ['title' => 'Egypt: artificial intelligence readiness assessment report', 'institution' => 'UNESCO', 'publish_date' => '2025-01-01', 'data_link' => 'https://unesdoc.unesco.org/ark:/48223/pf0000395173', 'tags' => ['Egypt', 'National Policies', 'Data', 'Health', 'Inclusion', 'Environment']],
            ['title' => 'Saudi Arabia: artificial intelligence readiness assessment report', 'institution' => 'UNESCO', 'publish_date' => '2025-01-01', 'data_link' => 'https://unesdoc.unesco.org/ark:/48223/pf0000392184', 'tags' => ['National Policies', 'Data', 'Health', 'Inclusion', 'Environment', 'Infrastructures']],
            ['title' => 'AI and ealthcare in the MENA Region', 'institution' => 'Columbia Climate School', 'publish_date' => '2025-10-01', 'data_link' => '', 'tags' => ['MENA', 'Health']],
            ['title' => 'Global Megatrends and Human Development in the MENA Region: Preparing for Demographic, Climate, and Technological Change', 'institution' => 'World Bank Group', 'publish_date' => '2025-05-01', 'data_link' => 'https://documents1.worldbank.org/curated/en/099090825130022820/pdf/P502135-2cb78850-66d5-4c2e-80f6-ea2c21da5e53.pdf', 'tags' => ['Education']],
            ['title' => 'AI in Education in MENA: Snapshot of the Landscape and Emerging Opportunities', 'institution' => 'EdTech Hub', 'publish_date' => '2026-01-01', 'data_link' => 'https://docs.edtechhub.org/lib/EPJAMMH9/download/BHXDDPBB', 'tags' => ['MENA', 'Education']],
            ['title' => 'OECD Artificial Intelligence Review of Egypt', 'institution' => 'OECD', 'publish_date' => '2024-01-01', 'data_link' => 'https://www.oecd.org/content/dam/oecd/en/publications/reports/2024/05/oecd-artificial-intelligence-review-of-egypt_3c437131/2a282726-en.pdf', 'tags' => ['Economy', 'National Policies', 'Human Resources', 'Research and Development']],
            ['title' => 'AI Adoption in the Middle East: Big Leaps, Shortcoming, and New Opportunities', 'institution' => 'Logic Consulting', 'publish_date' => '2025-11-01', 'data_link' => 'https://logic-consulting.com/wp-content/uploads/2025/11/AI-Adoption-In-The-Middle-East.pdf', 'tags' => ['Economy', 'MENA']],
            ['title' => 'Desert Bytes: Why Gulf AI Ambitions Must Align with Energy and Water Realities', 'institution' => 'Middle Est Council on Global Affairs', 'publish_date' => '2026-09-04', 'data_link' => 'https://mecouncil.org/publication/gulf-ai-data-centers-water-energy/', 'tags' => ['Blog Post', 'Environment', 'MENA', 'Sustainable Development']],
            ['title' => 'How the Middle East and North Africa can optimize the region\'s data centres and AI infrastructure', 'institution' => 'World Economic Forum', 'publish_date' => '2026-01-05', 'data_link' => 'https://www.weforum.org/stories/2026/05/how-the-mena-region-can-optimize-its-data-centres-and-ai-infrastructure/', 'tags' => ['Blog Post', 'Environment', 'MENA', 'Sustainable Development']],
            ['title' => 'How Exposed Are Workers in MENA to AI? Evidence on Employment Risk and Task Complementarity', 'institution' => 'Economic Research Forum', 'publish_date' => '2026-05-01', 'data_link' => 'https://erf.org.eg/publications/how-exposed-are-workers-in-mena-to-ai-evidence-on-employment-risk-and-task-complementarity/', 'tags' => ['Human Resources', 'Economy', 'MENA', 'Egypt', 'Jordan', 'Tunisia', 'Vulnerable Communities']],
            ['title' => 'AI-Enabled Misconduct and Corporate Criminal Liability in Arab Jurisdictions: Offence Design, Evidence, and Cross-Border Enforcement', 'institution' => 'Corporate Law & Governance Review', 'publish_date' => '2026-08-01', 'data_link' => 'https://doi.org/10.22495/clgrv8i1p3', 'tags' => ['Egypt', 'AI Technology', 'Jordan', 'MENA']],
            ['title' => 'The Promise and Peril of AI in MENA’s Transregional Future: Solidarity or Further Disparities?', 'institution' => 'Middle East Critique', 'publish_date' => '2026-11-02', 'data_link' => 'https://www.tandfonline.com/doi/full/10.1080/19436149.2026.2616885#abstract', 'tags' => ['MENA', 'AI Technology', 'Economy']],
            ['title' => 'How the data center construction boom is shifting from hype to execution', 'institution' => 'Economy Middle East', 'publish_date' => '2026-06-05', 'data_link' => 'https://economymiddleeast.com/news/how-the-data-center-construction-boom-is-shifting-from-hype-to-execution/', 'tags' => ['MENA', 'Economy', 'AI Technology', 'Business Development']],
            ['title' => 'The Arab Middle Class in an Age of Disruption: Trade Fragmentation and Artificial Intelligence in the MENA Region', 'institution' => 'Future for Advanced Research and Studies', 'publish_date' => '2026-05-31', 'data_link' => 'https://futureuae.com/en-US/Mainpage/Item/11027/the-arab-middle-class-in-an-age-of-disruption-trade-fragmentation-and-artificial-intelligence-in-the-mena-region', 'tags' => ['MENA', 'AI Ethics', 'Development']],
            ['title' => 'AI in Education in MENA: Snapshot of the landscape and emerging opportunities', 'institution' => 'EdTech Hub', 'publish_date' => '2026-01-01', 'data_link' => 'https://docs.edtechhub.org/lib/EPJAMMH9/download/BHXDDPBB', 'tags' => ['Education', 'MENA', 'Development', 'Artificial Intelligence']],
            ['title' => 'Charting AI Governance Future in the Arab Region: A Policy Roadmap', 'institution' => 'World Governments Summit', 'publish_date' => '2026-02-27', 'data_link' => 'https://papers.ssrn.com/sol3/papers.cfm?abstract_id=6191138', 'tags' => ['Governing Responsible AI & Data in the MENA Region', 'MENA']],
            ['title' => 'New Evidence on the Geopolitical Risk–Carbon Emissions Nexus: The Moderating Role of Artificial Intelligence in Selected MENA Countries', 'institution' => 'May University in Cairo', 'publish_date' => '2026-03-01', 'data_link' => 'https://journals.ekb.eg/article_501801.html', 'tags' => ['Environment', 'MENA', 'Artificial Intelligence']],
            ['title' => 'Greening the digital stack with AI: An explainable fuzzy assessment of ICTs and sustainable development in MENA, with a Tunisia case study', 'institution' => 'Environmental Economics and Policy Studies', 'publish_date' => '2026-03-15', 'data_link' => 'https://link.springer.com/article/10.1007/s10018-026-00472-9', 'tags' => ['Tunisia', 'Sustainable Development', 'MENA', 'ICTs']],
            ['title' => 'The Water-Energy-Food Nexus and the AI Imperative', 'institution' => 'Observer Research Foundation Middle East', 'publish_date' => '2026-04-29', 'data_link' => 'https://orfme.org/expert-speak/the-water-energy-food-nexus-and-the-ai-imperative/', 'tags' => ['Sustainable Development', 'Environment', 'Renewable Energy', 'AI Technology', 'AgriTech and Food Security']],
            ['title' => 'Artificial Intelligence Enhanced Credit Scoring for MSMEs: A Policy Framework for Financial Sustainability in Emerging Economies', 'institution' => 'European Journal of Sustainable Development', 'publish_date' => '2026-01-06', 'data_link' => 'http://ecsdev.org/ojs/index.php/ejsd/article/view/2010', 'tags' => ['Economy', 'Policy', 'Development', 'AI Technology', 'Artificial Intelligence and Inclusion']],
            ['title' => 'Sustainable Future Through Ai: The Rise Of Green Ai Entrepreneurship In Mena’s Agritech Sector', 'institution' => 'Journal of Economic Papers', 'publish_date' => '2026-02-06', 'data_link' => 'https://asjp.cerist.dz/en/article/293903', 'tags' => ['Sustainable Development', 'Digital Entrepreneurship', 'MENA']],
            ['title' => 'Is sharing caring? Deepfakes and gender-based violence in MENA', 'institution' => 'Current Pychology', 'publish_date' => '2026-09-02', 'data_link' => 'https://link.springer.com/article/10.1007/s12144-026-09039-z', 'tags' => ['AI Technology', 'Gender', 'Egypt', 'Jordan', 'Morocco']],
            ['title' => 'AI-driven semantic information retrieval for Arabic language- systematic literature review', 'institution' => 'Computer Science Review', 'publish_date' => '2025-06-08', 'data_link' => 'https://www.sciencedirect.com/science/article/pii/S1574013726000298', 'tags' => ['AI Technology', 'MENA', 'Research']],
            ['title' => 'Digitalization for Sustainable Agri-Food Systems: Potential, Status, and Risks for the MENA Region', 'institution' => 'Sustainability', 'publish_date' => '2021-01-15', 'data_link' => 'https://pdfs.semanticscholar.org/bf2a/ced9767f14cf08b3387a4034fb3779e9d259.pdf', 'tags' => ['AgriTech and Food Security', 'AI Technology', 'Egypt', 'Jordan', 'Morocco', 'Tunisia']],
            ['title' => 'AI-Driven Sustainability and Cultural Shifts in Egyptian Organizations', 'institution' => 'Journal of Digital Media and Sustainable Development', 'publish_date' => '2026-01-01', 'data_link' => 'https://journals.ekb.eg/article_501649_21056796a146d170989105534d44bee6.pdf', 'tags' => ['Economy', 'Egypt', 'Sustainable Development', 'Governing Responsible AI & Data in the MENA Region']],
            ['title' => 'Artificial Intelligence in the Middle East and North Africa', 'institution' => 'Strategic Gears Management Consultancy', 'publish_date' => '2024-07-01', 'data_link' => 'https://argaamplus.s3.amazonaws.com/40e7609f-069d-4be8-8588-1ad3e8e92af0.pdf', 'tags' => ['Human Resources', 'Economic Growth', 'Egypt', 'Business Development']],
            ['title' => 'AI Integration in Education in the MENA Region: Will it Be a Driver of Social Inequality?', 'institution' => 'Global Campus of Human Rights', 'publish_date' => '2024-01-01', 'data_link' => 'https://repository.gchumanrights.org/server/api/core/bitstreams/d3c58797-06ec-469e-bf66-d07490a34f07/content', 'tags' => ['Education', 'Digital Inequalities', 'Tunisia', 'Lebanon', 'Data Governance', 'Governing Responsible AI & Data in the MENA Region']],
        ];
    }

    private function global(): array
    {
        return [
            ['title' => 'UNESCO Global Report on Cultural Policies, Culture: The Missing SDG', 'institution' => 'UNESCO', 'publish_date' => '2025-01-01', 'data_link' => 'https://unesdoc.unesco.org/ark:/48223/pf0000395504', 'tags' => ['AI Ethics', 'Artificial Intelligence', 'Inclusion']],
            ['title' => 'Encyclial Letter, Magnifica Humanitas: On Safeguarding the Human Person in the Time of Artificial Intelligence', 'institution' => 'Vatican City', 'publish_date' => '2026-05-15', 'data_link' => 'https://www.vatican.va/content/leo-xiv/en/encyclicals/documents/20260515-magnifica-humanitas.html', 'tags' => ['AI Ethics', 'Policy', 'Artificial Intelligence']],
            ['title' => 'Human-AI Interaction in Low- and Middle-Income Countries: Qualitative Study of How Local Human Factors Influence AI Development and Deployment', 'institution' => 'JMIR AI', 'publish_date' => '2026-03-06', 'data_link' => 'https://ai.jmir.org/2026/1/e78649/', 'tags' => ['Research and Development', 'Artificial Intelligence', 'Health']],
            ['title' => 'Advancing Food Security through Smart Farming: A Systematic Review of Technological Innovations and Sustainability Challenges', 'institution' => 'Earth and Environmental Sciences', 'publish_date' => '2026-01-01', 'data_link' => 'https://iopscience.iop.org/article/10.1088/1755-1315/1584/1/012029/pdf', 'tags' => ['AI Technology', 'AgriTech and Food Security', 'Sustainable Development']],
            ['title' => 'Integrating AI in Sustainable Food and Health Systems: Bridging Nutrigenomics, Clinical Care, and Engineering', 'institution' => 'Science International', 'publish_date' => '2026-01-21', 'data_link' => 'https://sciintl.scione.com/newfiles/sciintl.scione.com/339/339-SI.pdf', 'tags' => ['AgriTech and Food Security', 'AI Technology']],
            ['title' => 'AI and Smart Water Treatment: A Bibliometric Perspective on Emerging Technologies in Water Purification', 'institution' => 'Advanced Sciences and Technology Journal', 'publish_date' => '2025-10-16', 'data_link' => 'https://journals.ekb.eg/article_448866_1b7f478f48121bc30aad8543c2d38f43.pdf', 'tags' => ['AgriTech and Food Security', 'AI Technology']],
            ['title' => 'GenAI as a Catalyst for Water Sector Transformation: Summary of WRF Project 5321 Findings', 'institution' => 'The Water Research Foundation', 'publish_date' => '2025-09-01', 'data_link' => 'https://water-ai-nexus.org/wp-content/uploads/gen-ai-catalyst-for-water-sector-transformation.pdf', 'tags' => ['AgriTech and Food Security', 'AI Technology']],
            ['title' => 'Responsible and Inclusive Urban AI: Opportunities and Challenges for Advancing Sustainable Development Goals', 'institution' => 'Multistakeholder Forum on Science, Technology and Innovation for the SDGs', 'publish_date' => '2024-05-01', 'data_link' => 'https://sdgs.un.org/sites/default/files/2024-05/Isagah_Responsible%20and%20Inclusive%20Urban%20AI.pdf', 'tags' => ['City Resilience', 'Sustainable Development', 'Artificial Intelligence and Inclusion', 'Responsible AI']],
            ['title' => 'AI-Data Driven Urban Resilience: Transforming shantytowns in San Jose, Costa Rica, through digital twins and geospatial technologies', 'institution' => 'Ibero-American Society of Digital Graphics (SIGraDi)', 'publish_date' => '2025-01-01', 'data_link' => 'https://papers.cumincad.org/data/works/att/sigradi2025_401.pdf', 'tags' => ['Urban Development', 'City Resilience', 'AI Technology']],
            ['title' => 'Artificial Intelligence (AI) in Sustainable Urban Governance', 'institution' => 'Multi-Level Governance Platform for Climate (MLGP4Climate)', 'publish_date' => '2023-08-01', 'data_link' => 'https://mlgp4climate.com/uploads/MLGP%20Library/Useful%20Documents/English/936.pdf', 'tags' => ['Urban Development', 'City Resilience', 'AI Technology', 'Data Governance']],
            ['title' => 'Artificial Intelligence for Advancing Smart Cities', 'institution' => 'OECD', 'publish_date' => '2025-01-01', 'data_link' => 'https://www.oecd.org/content/dam/oecd/en/about/programmes/cfe/the-oecd-programme-on-smart-cities-and-inclusive-growth/Issues-Note-AI-for-advancing-smart-cities.pdf', 'tags' => ['Urban Development', 'City Resilience', 'AI Technology', 'Artificial Intelligence and Inclusion', 'Environment', 'Security']],
            ['title' => 'AI for Sustainability and Ecological Resilience in Urban Planning: Deploying Sociotechnical Data-driven Monitoring Systems', 'institution' => 'Boston University - Frederick S. Pardee School of Global Studies; Boston University', 'publish_date' => '2026-08-06', 'data_link' => 'https://papers.ssrn.com/sol3/papers.cfm?abstract_id=6875718', 'tags' => ['Urban Development', 'City Resilience', 'AI Technology', 'Artificial Intelligence and Inclusion', 'Environment']],
            ['title' => 'The Intersection of Gender Data Gaps and AI: Redefining Future Workplace', 'institution' => 'New University European Faculty of Law', 'publish_date' => '2025-03-01', 'data_link' => 'https://thedocs.worldbank.org/en/doc/9fe224595c1ecfe9e508d7f3be205a8d-0080012025/related/S2-8-P-Azra-Becirovic-paper.pdf', 'tags' => ['AI Technology', 'Business Development', 'Human Resources', 'Gender']],
            ['title' => 'Bridging the Divide: Women, AI, and the Quest for Equitable Futures', 'institution' => 'Global Scientific Journal', 'publish_date' => '2025-04-01', 'data_link' => 'https://www.globalscientificjournal.com/researchpaper/_Research_Bridging_the_Divide_Women_AI_and_the_Quest_for_Equitable_Futures.pdf', 'tags' => ['Digital Inequalities', 'Gender', 'AI Technology', 'Research and Development']],
            ['title' => 'Gender Parity in the Intelligent Age', 'institution' => 'World Economic Forum', 'publish_date' => '2025-03-01', 'data_link' => 'https://reports.weforum.org/docs/WEF_Gender_Parity_in_the_Intelligent_Age_2025.pdf', 'tags' => ['Human Resources', 'Economic Growth', 'AI Technology']],
            ['title' => 'Understanding Generative Artificial Intelligence\'s Implications on Gender Using a Value Chain Approach and a UNGP Lens', 'institution' => 'Aapti Institute', 'publish_date' => '2024-05-01', 'data_link' => 'https://www.undp.org/sites/g/files/zskgke326/files/2024-08/report_understanding_the_implications_of_genai_on_gender_undp_aapti_.pdf', 'tags' => ['AI Technology', 'Business Development', 'Human Resources']],
            ['title' => 'Towards Real Diversity and Gender Equality in Artificial Intelligence', 'institution' => 'Global Partnership on AI', 'publish_date' => '2023-11-01', 'data_link' => 'https://wp.oecd.ai/app/uploads/2025/05/Towards-Real-Diversity-and-Gender-Equality-in-Artificial-Intelligence-Advancement-Report.pdf', 'tags' => ['Gender', 'AI Ethics', 'Digital Inequalities', 'Artificial Intelligence and Inclusion', 'Sustainable Development']],
            ['title' => 'Global Evidence on Gender Gaps and Generative AI Over Time', 'institution' => 'Harvard Business School', 'publish_date' => '2026-05-01', 'data_link' => 'https://www.hbs.edu/ris/Publication%20Files/25-023_be8fb517-3dd5-40aa-97f9-4e42e1c8e6ff.pdf', 'tags' => ['AI Technology', 'Gender']],
            ['title' => 'AI Applications for Nutrition and Food Security Research', 'institution' => 'Wolters Kluwer Health Inc.', 'publish_date' => '2025-01-01', 'data_link' => 'https://nursing.ceconnection.com/files/AIApplicationsforNutritionandFoodSecurityResearchATaxonomyandCompetencies-1738339418351.pdf', 'tags' => ['AgriTech and Food Security', 'Artificial Intelligence', 'Research']],
            ['title' => 'The Use of Artificial Intelligence in Food and Agriculture Systems', 'institution' => 'Athena Infonomics, Global Research and Technology Development (GRTD)', 'publish_date' => '2025-10-01', 'data_link' => 'https://www.grtd.fcdo.gov.uk/wp-content/uploads/2025/11/State-of-Art-Report.pdf', 'tags' => ['AI Ethics', 'AgriTech and Food Security', 'Research and Development']],
            ['title' => 'Artificial Intelligence for Food and Health', 'institution' => 'UC Davis Innovation Institute for Food and Health', 'publish_date' => '2024-01-01', 'data_link' => 'https://foodandhealth.ucdavis.edu/wp-content/uploads/2024/04/Artificial-Intelligence-for-Food-and-Health-1.pdf', 'tags' => ['AgriTech and Food Security', 'Health']],
            ['title' => 'AI for Impact: The Role of Artificial Intelligence in Social Innovation in Asia', 'institution' => 'World Economic Forum', 'publish_date' => '2026-06-01', 'data_link' => 'https://reports.weforum.org/docs/WEF_AI_for_Impact_The_Role_of_Artificial_Intelligence_in_Social_Innovation_in_Asia_2026.pdf', 'tags' => ['Health', 'AgriTech and Food Security', 'Renewable Energy', 'Environment', 'Sustainable Development', 'AI Technology']],
            ['title' => 'AI for Productivity and Empowerment in Agriculture, Health, Education, and Transport', 'institution' => 'UNDP', 'publish_date' => '2025-11-01', 'data_link' => 'https://www.undp.org/sites/g/files/zskgke326/files/2025-12/ai-for-productivity-and-empowerment-in-agriculture-health-education-and-transport.pdf', 'tags' => ['Health', 'AgriTech and Food Security', 'Education', 'Infrastructures', 'Digital Inequalities', 'Artificial Intelligence and Inclusion']],
        ];
    }
}
