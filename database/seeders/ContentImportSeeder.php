<?php

namespace Database\Seeders;

use App\Models\Events;
use App\Models\News;
use App\Models\Repo;
use App\Models\Repo_tags;
use Illuminate\Database\Seeder;

class ContentImportSeeder extends Seeder
{
    public function run(): void
    {
        // ── Tags ──────────────────────────────────────────────────────────────
        Repo_tags::firstOrCreate(['name' => 'Gender']);
        Repo_tags::firstOrCreate(['name' => 'fow']);
        Repo_tags::firstOrCreate(['name' => 'Webinar']);

        // ── Events ────────────────────────────────────────────────────────────
        $events = [
            [
                'title'       => "Roundtable on Egypt's draft AI Bill",
                'description' => 'High-level roundtable hosted by A2K4D with the MENA Observatory on Responsible AI, led by MP Sahar Al Bazar. Explored AI regulation, data governance, accountability, and responsible AI policy.',
                'start_date'  => '2025-01-14',
                'location'    => 'AUC New Cairo Campus, Egypt',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'A2K4D 15th Anniversary Workshop — AI, Future of Work & Development',
                'description' => "Workshop titled 'The Role of Research in Impacting Policy and Practice: AI, the Future of Work, and Development in the MENA Region.' Roundtable with global researchers, academics, civil society, and entrepreneurs. Recording: https://www.youtube.com/watch?v=779K-y-BZZQ",
                'start_date'  => '2025-02-03',
                'location'    => 'AUC Tahrir Campus, Oriental Hall',
                'type'        => 'In Person',
                'tags'        => ['fow'],
            ],
            [
                'title'       => 'AI Action Summit, Paris Peace Forum',
                'description' => 'MENA Observatory presented as one of 50 innovative projects selected by the Paris Peace Forum out of 770 applicants across 111 countries. Dr. Nagla Rizk presented the Observatory as a regional hub for responsible AI research.',
                'start_date'  => '2025-02-10',
                'end_date'    => '2025-02-11',
                'location'    => 'Paris, France',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'UNESCO National Stakeholder Consultation on Ethics of AI — Assessing AI Readiness in Egypt',
                'description' => 'Dr. Nagla Rizk attended Egypt\'s National Stakeholder Consultation on Ethics of AI between MCIT, UNESCO, and the EU. Covered AI readiness, principles, ecosystem, risks, ethics, and responsible AI.',
                'start_date'  => '2025-02-16',
                'location'    => 'Egypt',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'Extending Social Protection to Platform Workers: Applications in Egypt (Webinar)',
                'description' => 'Webinar hosted by the Observatory as part of the project on "New Work, Data, and Inclusion in the Digital Economy: A MENA Perspective," in partnership with Ford Foundation and the Fairwork project. Recording: https://www.youtube.com/watch?v=6m3LkkE0rK4',
                'start_date'  => '2025-02-25',
                'location'    => 'Online',
                'type'        => 'Online',
                'tags'        => ['fow', 'Webinar'],
            ],
            [
                'title'       => 'ILO Global Alliance on Social Justice — Platform Economy in Egypt',
                'description' => 'Dr. Nagla Rizk joined as a panelist on the Platform Economy in Egypt, in cooperation with the Ministry of Labor.',
                'start_date'  => '2025-03-06',
                'location'    => 'Egypt',
                'type'        => 'In Person',
                'tags'        => ['fow'],
            ],
            [
                'title'       => 'Gender and the Future of Work — ERF + UNDP Virtual Workshop',
                'description' => 'Virtual workshop presenting findings from six research studies on gender and the future of work in Arab States. Dr. Nagla Rizk contributed as commentator on "Gender Dynamics in the Digital Economy."',
                'start_date'  => '2025-03-10',
                'location'    => 'Online',
                'type'        => 'Online',
                'tags'        => ['Gender'],
            ],
            [
                'title'       => 'Gender Rights in AI Governance: Insights from the Global Index on Responsible AI',
                'description' => 'Online webinar organized by the Global Center on AI Governance. Dr. Nagla Rizk responded to the Gender Equality report findings and discussed practical solutions for advancing gender equality in AI.',
                'start_date'  => '2025-03-11',
                'location'    => 'Online',
                'type'        => 'Online',
                'tags'        => ['Gender', 'Webinar'],
            ],
            [
                'title'       => 'AI for Beginners — Practical Session for the Cairo Community',
                'description' => 'Session led by MENA Observatory Consultant Marwa Soudi at Kasr El-Dobara Evangelical Church (KDEC) as part of the "Khatwa" initiative. Covered core AI concepts, benefits, challenges, and risks. Recording: https://www.youtube.com/watch?v=4YmXs-ECKHc',
                'start_date'  => '2025-04-06',
                'location'    => 'Kasr El Dobara Evangelical Church, Cairo',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'Arabi Facts Hub × MENA Observatory Webinar',
                'description' => 'Collaborative webinar between Arabi Facts Hub and the MENA Observatory on Responsible AI.',
                'start_date'  => '2026-04-08',
                'location'    => 'Online',
                'type'        => 'Online',
                'tags'        => ['Webinar'],
            ],
            [
                'title'       => 'AI, Gender and Work: Perspectives from the Middle East and Africa',
                'description' => 'Third webinar in the Collaborative Webinar Series between MENA & African Observatories on Responsible AI. Examined AI impact on work and gender, digital divides, skills gaps, and the importance of reskilling for workforce readiness. Recording: https://www.youtube.com/watch?v=lX6PQKr8kKQ',
                'start_date'  => '2025-04-09',
                'location'    => 'Online',
                'type'        => 'Online',
                'tags'        => ['Gender', 'Webinar'],
            ],
            [
                'title'       => "Chatham House — 'How prepared are MENA countries for digital transformation and decarbonization?'",
                'description' => "Dr. Nagla Rizk spoke in the session 'Economic reform, technology and the future of work in the MENA region' at the Royal Institute of International Affairs, Chatham House.",
                'start_date'  => '2025-04-14',
                'location'    => 'Chatham House, London',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'Responsible AI in Egypt: Multi-Stakeholder Roundtable',
                'description' => 'Roundtable bringing together tech sector leaders, multinationals, entrepreneurs, civil society and academia to develop collective guidelines for responsible AI in Egypt. Policy brief produced following the meeting.',
                'start_date'  => '2025-05-04',
                'location'    => 'Egypt',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'Lebanese American University — What is Feminist Artificial Intelligence?',
                'description' => "Talk on growing the feminist AI research network's MENA Hub. Co-organized by the Arab Institute for Women, Center for Innovative Learning, and the Department of Communications, Mobility and Identity, LAU. Recording: https://youtu.be/U5dSlgsdPD4?t=10",
                'start_date'  => '2025-05-14',
                'location'    => 'Online',
                'type'        => 'Online',
                'tags'        => ['Gender', 'Webinar'],
            ],
            [
                'title'       => 'AI in Research Management: Ethical Implications and Responsible Solutions',
                'description' => "Dr. Nagla Rizk participated in a webinar as part of the EDI Working Group sessions during the Global Research Council's Annual Meeting. Discussed AI's dual role in inclusive development and risks of inequality.",
                'start_date'  => '2025-05-18',
                'location'    => 'Online',
                'type'        => 'Online',
                'tags'        => [],
            ],
            [
                'title'       => 'IPX Summit at Harvard Law School',
                'description' => "Dr. Nagla Rizk participated at the IPX Summit organized by Professors William Fisher and Ruth Okediji. Presented 10 years of teaching CopyrightX at AUC and discussed AI & IP from global perspectives.",
                'start_date'  => '2025-06-11',
                'location'    => 'Harvard Law School, USA',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'AI for Good Summit, Geneva',
                'description' => 'MENA Observatory represented by Maha Bali and Khadiga Hassan at the AI for Good Summit 2025 in Geneva.',
                'start_date'  => '2025-07-08',
                'end_date'    => '2025-07-11',
                'location'    => 'Geneva, Switzerland',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'AI Business Models for Application in Business (GIZ Egypt Webinar)',
                'description' => 'Webinar by GIZ Egypt in partnership with MENA Observatory, A2K4D and University of Sussex. Covered AI models for business, AI for productivity and efficiency, and ethical considerations in AI deployment. Recording: https://www.youtube.com/watch?v=oqRmx8mkdXc',
                'start_date'  => '2025-09-08',
                'location'    => 'Online',
                'type'        => 'Online',
                'tags'        => ['Webinar'],
            ],
            [
                'title'       => "Meta's Llama Design Drive Pitchathon — Techne Summit Cairo",
                'description' => "Dr. Nagla Rizk served as a judge at Meta's Llama Design Drive Pitchathon during the Techne Summit in Cairo, evaluating AI-driven startup pitches on innovation, scalability, and market impact.",
                'start_date'  => '2025-09-30',
                'location'    => 'Cairo, Egypt',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'AI Ethics in Policy: Perspectives from MENA (IFAP + UNESCO Seminar)',
                'description' => "Regional seminar by the Observatory in collaboration with UNESCO's IFAP Working Group on Information Ethics. Examined AI ethics and policy in MENA via regional case studies from Egypt, Qatar, Lebanon, and Morocco. Recording: https://www.youtube.com/watch?v=uNKYSkha--0",
                'start_date'  => '2025-10-22',
                'location'    => 'Online',
                'type'        => 'Online',
                'tags'        => ['Webinar'],
            ],
            [
                'title'       => 'Forging the Future: A Dialogue on Beneficial AI for Children, Starting with Principles',
                'description' => 'Roundtable co-organized with everyone.ai at the iRAISE Lab presenting design principles for adolescent-AI interaction, addressing sycophancy, anthropomorphism, and relational reliance.',
                'start_date'  => '2025-10-29',
                'location'    => 'Paris, France',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => "Paris Peace Forum 2025 — 'New Coalitions for Peace, People and the Planet'",
                'description' => 'Dr. Nagla Rizk and Nagham El Houssamy represented the MENA Observatory at Paris Peace Forum 2025, building coalitions around global AI governance, climate, and development challenges.',
                'start_date'  => '2025-10-29',
                'location'    => 'Paris, France',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'Responsible Artificial Intelligence and Civil Society Roundtable',
                'description' => "Roundtable hosted by the MENA Observatory for Egyptian civil society organizations exploring responsible AI opportunities and challenges. Led to collaboration with Egypt's Civil Society Support Fund for the annual Sociathon event.",
                'start_date'  => '2025-11-11',
                'location'    => 'Egypt',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'META AI Summit London (MENA Policy Summit 2025)',
                'description' => 'Dr. Nagla Rizk attended the MENA Policy Summit 2025 in London covering AI governance, data privacy, content risks, and AI adoption across the MENA region.',
                'start_date'  => '2025-11-17',
                'end_date'    => '2025-11-18',
                'location'    => 'London, UK',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'INDL MEA-2 Conference — Digital Labor in the Middle East and Africa',
                'description' => "Second edition of the International Network on Digital Labor – ME & Africa Conference, co-organized with INDL, Université d'Angers, ILO, and DiPLab. Dr. Rizk delivered keynote on Women, AI and Work in ME & Africa. Recording: https://www.youtube.com/watch?v=I5FshSboCHI",
                'start_date'  => '2025-11-25',
                'end_date'    => '2025-11-26',
                'location'    => 'Online',
                'type'        => 'Online',
                'tags'        => ['fow', 'Webinar'],
            ],
            [
                'title'       => 'Utilising AI and ML to Optimise Humanitarian Aid Performance — Egyptian Food Bank',
                'description' => "Dr. Nagla Rizk spoke on AI governance, dignity, and human outcomes in humanitarian aid. Highlighted AI alignment with SDGs (poverty, hunger, health) and the Observatory's role in responsible AI advocacy.",
                'start_date'  => '2025-12-18',
                'location'    => 'Online',
                'type'        => 'Online',
                'tags'        => ['Webinar'],
            ],
            [
                'title'       => 'AI India Impact Summit 2026 — Cairo Outreach',
                'description' => 'Dr. Nagla Rizk joined as a panelist at the India AI Impact Summit 2026 Cairo Outreach event, convened by the Embassy of India in Cairo. Focused on human-centric AI and India-Egypt collaboration.',
                'start_date'  => '2025-12-23',
                'location'    => 'Cairo, Egypt',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'Johns Hopkins Berman Institute — What is Feminist AI? Perspectives from MENA',
                'description' => "Dr. Nagla Rizk presented the meaning and need for a feminist lens in AI, drawing on work at the MENA Observatory and her course 'Feminist AI, Technology, Gender and Development' at AUC. Recording: https://youtu.be/Agd7ETNsodA",
                'start_date'  => '2026-02-09',
                'location'    => 'Online',
                'type'        => 'Online',
                'tags'        => ['Gender', 'Webinar'],
            ],
            [
                'title'       => 'AI and Economic Development Pathways in Africa — Global Center on AI Governance',
                'description' => "Dr. Nagla Rizk described AI's economic relevance, productivity channels, and innovation potential, and analyzed how economic theories of technological change can inform AI policy choices in Africa.",
                'start_date'  => '2026-03-02',
                'location'    => 'Online',
                'type'        => 'Online',
                'tags'        => [],
            ],
            [
                'title'       => 'Anah Exhibition — AUC Tahrir Culture Fest',
                'description' => "Bilingual multimedia exhibition by Samia Mehrez '77 and Amr Ali exploring emotional and ethical dimensions of human–AI collaboration. Features sculptural figurines from recycled plastic, interactive projections, sound, and real-time AI-generated text.",
                'start_date'  => '2026-04-02',
                'end_date'    => '2026-04-04',
                'location'    => 'Future Gallery, Tahrir Campus, AUC',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'Al Khwarizmi AI Event — Cairo Convening',
                'description' => 'Closed one-day discussion on the state of AI in Egypt covering uses, social impacts, public policies, legal frameworks, public literacy, and future prospects. Co-organized with AUC GAPP Exec Ed and A2K4D.',
                'start_date'  => '2026-04-27',
                'location'    => 'Cairo, Egypt',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'Convergence Summit — AUC Robotics Summit: Where Robotics Meets the Human Condition',
                'description' => 'Student-led national initiative at AUC Tahrir Campus. MENA Observatory session: "Responsible AI for Policy, Practice and People: from Research to Impact." Keynote by Dr. Nagla Rizk.',
                'start_date'  => '2026-05-02',
                'location'    => 'AUC Tahrir Campus, Cairo',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => "Ahmed Darwish International Conference on AI — 'The Future of Education, Industry Integration and International Partnerships'",
                'description' => "Dr. Nagla Rizk participates as a speaker. Conference held under the patronage of Ahmed Al-Tayeb, Sheikh of Al-Azhar, featuring Springer and UNESCO Chair on AI in Education.",
                'start_date'  => '2026-05-07',
                'location'    => 'Egypt',
                'type'        => 'In Person',
                'tags'        => [],
            ],
            [
                'title'       => 'Adsero Law Firm × A2K4D Event',
                'description' => 'Upcoming event in collaboration between Adsero Law Firm and A2K4D / MENA Observatory on Responsible AI.',
                'start_date'  => '2026-05-10',
                'location'    => 'Egypt',
                'type'        => 'In Person',
                'tags'        => [],
            ],
        ];

        foreach ($events as $data) {
            $tagNames = $data['tags'] ?? [];
            unset($data['tags']);
            $data['image'] = $data['image'] ?? '';
            $event = Events::create($data);
            foreach ($tagNames as $name) {
                $tag = Repo_tags::firstOrCreate(['name' => $name]);
                $event->tags()->attach($tag->id);
            }
        }

        // ── News (media appearances) ──────────────────────────────────────────
        $newsItems = [
            [
                'title'       => 'Al Arabiya TV — Dr. Nagla Rizk on AI Opportunities in MENA (AI Action Summit)',
                'description' => 'First interview with Dr. Nagla Rizk shedding light on AI opportunities and challenges in the MENA region, coinciding with the Paris Peace Forum AI Action Summit where the Observatory was selected as one of the top 50 projects.',
                'date'        => '2025-02-10',
                'data_link'   => 'https://www.youtube.com/watch?v=XEdWltC6X_g',
                'tags'        => [],
            ],
            [
                'title'       => 'Al Arabiya TV — Nagham ElHoussamy on AI Trends in MENA',
                'description' => 'Interview with Nagham ElHoussamy, Associate Director for Research at the MENA Observatory, contributing key insights on major AI landscape trends in the MENA region during the AI Action Summit.',
                'date'        => '2025-02-10',
                'data_link'   => 'https://youtu.be/nspp99x4fls?t=19',
                'tags'        => [],
            ],
            [
                'title'       => "France 24 — 'The Impact of AI in the MENA Region'",
                'description' => "A2K4D's Director Dr. Nagla Rizk discussed the impact of AI in the MENA region on France 24 during the AI Action Summit period.",
                'date'        => '2025-02-10',
                'data_link'   => 'https://www.youtube.com/watch?v=XEdWltC6X_g',
                'tags'        => [],
            ],
            [
                'title'       => 'Paris Peace Forum 2025 — Video Recording',
                'description' => 'Recording from the Paris Peace Forum 2025 attended by Dr. Nagla Rizk and Nagham El Houssamy representing the MENA Observatory on Responsible AI.',
                'date'        => '2025-10-29',
                'data_link'   => 'https://www.youtube.com/watch?v=Hkeco_f1KjE',
                'tags'        => [],
            ],
            [
                'title'       => "Le Monde — L'IA pourrait représenter un puissant levier pour réduire les inégalités (AI & Education Equity)",
                'description' => 'Le Monde article published during the "Forging the Future: A Dialogue on Beneficial AI for Children" session at the iRAISE event in Paris, co-organized by the Observatory.',
                'date'        => '2025-10-29',
                'data_link'   => 'https://www.lemonde.fr/idees/article/2025/10/29/l-ia-pourrait-representer-un-puissant-levier-pour-reduire-les-inegalites-entre-differents-milieux-socioculturels_6650132_3232.html',
                'tags'        => [],
            ],
            [
                'title'       => 'Navigating AI Governance in Africa, the Middle East & Turkey: Is Harmonization Possible?',
                'description' => 'Video recording of the panel discussion on AI governance alignment across the AMET (Africa, Middle East & Türkiye) region, featuring Observatory contributions.',
                'date'        => '2026-01-01',
                'data_link'   => '',
                'tags'        => [],
            ],
        ];

        foreach ($newsItems as $data) {
            $tagNames = $data['tags'] ?? [];
            unset($data['tags']);
            $news = News::create($data);
            foreach ($tagNames as $name) {
                $tag = Repo_tags::firstOrCreate(['name' => $name]);
                $news->tags()->attach($tag->id);
            }
        }

        // ── Repos (publications) ──────────────────────────────────────────────
        $publications = [
            [
                'title'        => 'Toward AI Governance Alignment in Africa, Middle East, and Türkiye (AMET) Region',
                'description'  => 'Co-authored report on AI governance alignment across the AMET region. Authors include Emma Ruttkamp-Bloem, Fola Adeleke, Jake Effoduh, Prof Nagla Rizk, Dr. Olubayo Adekanmbi, Rachel Adams, and others.',
                'is_our_work'  => true,
                'is_global'    => true,
                'data_link'    => 'https://www.globalcenter.ai/research/toward-ai-governance-alignment-in-africa-middle-east-and-tuerkiye-amet-region',
                'publish_date' => '2026-01-01',
                'tags'         => [],
            ],
            [
                'title'        => 'The Fourth Industrial Revolution, Artificial Intelligence, and the Future of Work in Egypt',
                'description'  => 'Research paper by Rizk, Nagla and Ayman Ismail examining the impact of the Fourth Industrial Revolution and AI on the future of work in Egypt.',
                'is_our_work'  => true,
                'is_global'    => false,
                'data_link'    => '',
                'publish_date' => '2020-06-01',
                'tags'         => ['fow'],
            ],
        ];

        foreach ($publications as $data) {
            $tagNames = $data['tags'] ?? [];
            unset($data['tags']);
            $repo = Repo::create($data);
            foreach ($tagNames as $name) {
                $tag = Repo_tags::firstOrCreate(['name' => $name]);
                $repo->tags()->attach($tag->id);
            }
        }
    }
}
