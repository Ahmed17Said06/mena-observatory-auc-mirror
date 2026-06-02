<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Repo;
use App\Models\Repo_tags;
use Illuminate\Database\Seeder;

class RegionalResearchAndNewsSeeder extends Seeder
{
    public function run(): void
    {
        // -- Repos (regional and global external research) -----------------
        $publications = [
            [
                'title'        => 'AI and the MENA Workforce: Translating Digital Transformation into Human Transformation',
                'description'  => 'Journal of Business Theory and Practice',
                'publish_date' => '2025-09-28',
                'data_link'    => 'https://dx.doi.org/10.22158/jbtp.v13n2p87',
                'is_global'    => false,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['MENA', 'Responsible AI', 'Economy', 'Human Resources'],
            ],
            [
                'title'        => 'ALECSO Charter on Artificial Intelligence Ethics',
                'description'  => ' Arab League Educational, Cultural and Scientific Organization',
                'publish_date' => '2025-06-01',
                'data_link'    => 'https://www.alecso.org/publications/uploads/2025/08/etic.pdf',
                'is_global'    => false,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['AI Ethics', 'MENA'],
            ],
            [
                'title'        => 'Artificial Intelligence Futures for the Arab Region',
                'description'  => 'UNESCWA',
                'publish_date' => '2025-06-01',
                'data_link'    => 'https://www.unescwa.org/sites/default/files/pubs/pdf/artificial-intelligence-futures-arab-region-english.pdf',
                'is_global'    => false,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['Sustainable Development', 'AI Technology', 'MENA'],
            ],
            [
                'title'        => 'Artificial Intelligence (AI) and Employment in the Arab Countries',
                'description'  => 'Annual Conference of the Arab Society for Economic Research',
                'publish_date' => '2024-09-15',
                'data_link'    => 'https://www.asfer.org/001/wp-content/uploads/2024/12/“Artificial-Intelligence-AI-and-Employment-in-the-Arab-Countries”.pdf',
                'is_global'    => false,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['Economy'],
            ],
            [
                'title'        => 'Artificial Intelligence and Employment Futures for the Arab Region',
                'description'  => 'International Labour Organization',
                'publish_date' => '2026-05-21',
                'data_link'    => 'https://www.ilo.org/sites/default/files/2026-05/2500858E_AI-and-Employment-Futures-for-the-Arab-Region-E-final.pdf',
                'is_global'    => false,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['Economy'],
            ],
            [
                'title'        => 'Egypt: artificial intelligence readiness assessment report',
                'description'  => 'UNESCO',
                'publish_date' => '2025-01-01',
                'data_link'    => 'https://unesdoc.unesco.org/ark:/48223/pf0000395173',
                'is_global'    => false,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['Egypt', 'National Policies', 'Data', 'Health', 'Inclusion', 'Environment'],
            ],
            [
                'title'        => 'Saudi Arabia: artificial intelligence readiness assessment report',
                'description'  => 'UNESCO',
                'publish_date' => '2025-01-01',
                'data_link'    => 'https://unesdoc.unesco.org/ark:/48223/pf0000392184',
                'is_global'    => false,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['National Policies', 'Data', 'Health', 'Inclusion', 'Environment', 'Infrastructures'],
            ],
            [
                'title'        => 'AI and ealthcare in the MENA Region',
                'description'  => 'Columbia Climate School',
                'publish_date' => '2025-10-01',
                'data_link'    => '',
                'is_global'    => false,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['MENA', 'Health'],
            ],
            [
                'title'        => 'Global Megatrends and Human Development in the MENA Region: Preparing for Demographic, Climate, and Technological Change',
                'description'  => 'World Bank Group',
                'publish_date' => '2025-05-01',
                'data_link'    => 'https://documents1.worldbank.org/curated/en/099090825130022820/pdf/P502135-2cb78850-66d5-4c2e-80f6-ea2c21da5e53.pdf',
                'is_global'    => false,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['Education'],
            ],
            [
                'title'        => 'AI in Education in MENA: Snapshot of the Landscape and Emerging Opportunities',
                'description'  => 'EdTech Hub',
                'publish_date' => '2026-01-01',
                'data_link'    => 'https://docs.edtechhub.org/lib/EPJAMMH9/download/BHXDDPBB',
                'is_global'    => false,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['MENA', 'Education'],
            ],
            [
                'title'        => 'OECD Artificial Intelligence Review of Egypt',
                'description'  => 'OECD',
                'publish_date' => '2024-01-01',
                'data_link'    => 'https://www.oecd.org/content/dam/oecd/en/publications/reports/2024/05/oecd-artificial-intelligence-review-of-egypt_3c437131/2a282726-en.pdf',
                'is_global'    => false,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['Economy', 'National Policies', 'Human Resources', 'Research and Development'],
            ],
            [
                'title'        => 'AI Adoption in the Middle East: Big Leaps, Shortcoming, and New Opportunities',
                'description'  => 'Logic Consulting',
                'publish_date' => '2025-11-01',
                'data_link'    => 'https://logic-consulting.com/wp-content/uploads/2025/11/AI-Adoption-In-The-Middle-East.pdf',
                'is_global'    => false,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['Economy', 'MENA'],
            ],
            [
                'title'        => 'Desert Bytes: Why Gulf AI Ambitions Must Align with Energy and Water Realities',
                'description'  => 'Middle Est Council on Global Affairs',
                'publish_date' => '2026-09-04',
                'data_link'    => 'https://mecouncil.org/publication/gulf-ai-data-centers-water-energy/',
                'is_global'    => false,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['Blog Post', 'Environment', 'MENA', 'Sustainable Development'],
            ],
            [
                'title'        => 'How the Middle East and North Africa can optimize the region\'s data centres and AI infrastructure',
                'description'  => 'World Economic Forum',
                'publish_date' => '2026-01-05',
                'data_link'    => 'https://www.weforum.org/stories/2026/05/how-the-mena-region-can-optimize-its-data-centres-and-ai-infrastructure/',
                'is_global'    => false,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['Blog Post', 'Environment', 'MENA', 'Sustainable Development'],
            ],
            [
                'title'        => 'How Exposed Are Workers in MENA to AI? Evidence on Employment Risk and Task Complementarity',
                'description'  => 'Economic Research Forum',
                'publish_date' => '2026-05-01',
                'data_link'    => 'https://erf.org.eg/publications/how-exposed-are-workers-in-mena-to-ai-evidence-on-employment-risk-and-task-complementarity/',
                'is_global'    => false,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['Human Resources', 'Economy', 'MENA', 'Egypt', 'Jordan', 'Tunisia', 'Vulnerable Communities'],
            ],
            [
                'title'        => 'UNESCO Global Report on Cultural Policies, Culture: The Missing SDG',
                'description'  => 'UNESCO',
                'publish_date' => '2025-01-01',
                'data_link'    => 'https://unesdoc.unesco.org/ark:/48223/pf0000395504',
                'is_global'    => true,
                'is_our_work'  => false,
                'image'        => '',
                'tags'         => ['AI Ethics', 'Artificial Intelligence', 'Inclusion'],
            ],
        ];

        foreach ($publications as $data) {
            $tagNames = $data['tags'];
            unset($data['tags']);
            $data['country_id'] = $data['country_id'] ?? null;

            if (Repo::where('title', $data['title'])->exists()) {
                continue;
            }

            $repo = Repo::create($data);

            foreach ($tagNames as $name) {
                $tag = Repo_tags::firstOrCreate(['name' => $name]);
                $repo->tags()->attach($tag->id);
            }
        }

        // -- News items ----------------------------------------------------
        $newsItems = [
            [
                'title'       => 'Government Meeting: Review Of The Draft National Artificial Intelligence Strategy',
                'date'        => '2026-05-25',
                'data_link'   => 'https://news.radioalgerie.dz/en/node/86938',
                'description' => 'Source: Algeriaan Radio Multimedia',
                'image'       => '',
            ],
            [
                'title'       => 'Arab women\'s voices \'must be heard\' in AI revolution',
                'date'        => '2026-05-27',
                'data_link'   => 'https://www.thenationalnews.com/news/uk/2026/05/27/plea-for-arab-womens-voices-to-be-heard-in-ai-revolution/',
                'description' => 'Source: The National',
                'image'       => '',
            ],
            [
                'title'       => 'NVIDIA AI Cloud Ecosystem Expands Worldwide to Meet Global AI Compute Demand',
                'date'        => '2026-05-31',
                'data_link'   => 'https://blogs.nvidia.com/blog/ai-cloud-ecosystem/',
                'description' => 'Source: Nvidia',
                'image'       => '',
            ],
        ];

        foreach ($newsItems as $data) {
            if (News::where('title', $data['title'])->exists()) {
                continue;
            }
            $data['content']    = $data['content'] ?? '';
            $data['image']      = $data['image'] ?? '';
            $data['featured']   = $data['featured'] ?? 'no';
            $data['country_id'] = $data['country_id'] ?? null;
            News::create($data);
        }
    }
}
