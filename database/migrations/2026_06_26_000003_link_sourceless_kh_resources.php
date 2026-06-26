<?php

use App\Models\Repo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

/**
 * Attach official source links to Knowledge Hub resources that had no file or
 * link at all (so their detail page showed nothing to view and they got no
 * cover). URLs were located individually and verified to resolve. Direct-PDF
 * links also let `repos:fetch-covers` render a cover on the next run; landing
 * pages at least make the resource reachable via "View Source".
 *
 * Safe & idempotent: each row is matched by id + a title fragment and is only
 * updated when it currently has NO data_link / en_pdf / ar_pdf, so any curated
 * link is never overwritten and it no-ops on a DB where the row differs.
 */
return new class extends Migration
{
    /** id => [title fragment, source url] */
    private array $map = [
        107 => ['Nordic initiative', 'https://norden.diva-portal.org/smash/get/diva2:1856812/FULLTEXT02.pdf'],
        108 => ['ASEAN Responsible AI', 'https://asean.org/wp-content/uploads/2025/02/ASEAN-Responsible-AI-Roadmap-Final.docx.pdf'],
        110 => ['Recommendation on the Ethics', 'https://www.ohchr.org/sites/default/files/2022-03/UNESCO.pdf'],
        111 => ['AGILE Index', 'https://arxiv.org/pdf/2507.11546'],
        114 => ['Journalism', 'https://www.coe.int/en/web/freedom-expression/-/guidelines-on-the-responsible-implementation-of-artificial-intelligence-ai-systems-in-journalism'],
        115 => ['Generative AI in Education', 'https://unesdoc.unesco.org/ark:/48223/pf0000385877'],
        116 => ['Competency Framework for Teachers', 'https://www.cedefop.europa.eu/files/unesco_ai_competency_framework_for_teachers.pdf'],
        121 => ['Artificial Intelligence in the Public Sector', 'https://www.oecd.org/content/dam/oecd/en/publications/reports/2024/10/g7-toolkit-for-artificial-intelligence-in-the-public-sector_f93fb9fb/421c1244-en.pdf'],
        136 => ['Establishing responsible use of AI', 'https://pmc.ncbi.nlm.nih.gov/articles/PMC11608363/'],
        137 => ['Guidance on AI and children', 'https://www.unicef.org/innocenti/reports/policy-guidance-ai-children'],
        141 => ['Governing Artificial Intelligence Responsibility', 'https://scholarlycommons.law.cwsl.edu/cwilj/vol54/iss2/3/'],
        145 => ['agriculture requires systemic', 'https://www.nature.com/articles/s42256-022-00440-4'],
        146 => ['strengthening healthcare systems', 'https://pmc.ncbi.nlm.nih.gov/articles/PMC9614192/'],
        148 => ['Disrupting Teachers', 'https://docs.edtechhub.org/lib/UXT3K2K3/download/CYLYQJYC'],
        150 => ['Education Ministries to Improve Service Delivery', 'https://docs.edtechhub.org/lib/FPN46G82'],
        152 => ['Data Sharing Related to Artificial Intelligence', 'https://pmc.ncbi.nlm.nih.gov/articles/PMC11836587/'],
        153 => ['Generative AI for Health', 'https://cdh.stanford.edu/sites/g/files/sbiybj29486/files/media/file/stanford_scdh_genaiwhitepaper_v18_compressed.pdf'],
        162 => ['AI in Education in MENA', 'https://docs.edtechhub.org/lib/EPJAMMH9/download/BHXDDPBB'],
        165 => ['optimize the region', 'https://www.weforum.org/stories/2026/05/how-the-mena-region-can-optimize-its-data-centres-and-ai-infrastructure/'],
        167 => ['Cultural Policies', 'https://unesdoc.unesco.org/ark:/48223/pf0000395707'],
        170 => ['Promise and Peril of AI', 'https://www.tandfonline.com/doi/full/10.1080/19436149.2026.2616885'],
        173 => ['Charting AI Governance', 'https://www.worldgovernmentssummit.org/observer/reports/detail/charting-ai-governance-future-in-the-arab-region-a-policy-roadmap'],
        175 => ['Greening the digital stack', 'https://link.springer.com/article/10.1007/s10018-026-00472-9'],
        179 => ['sharing caring', 'https://link.springer.com/article/10.1007/s12144-026-09039-z'],
    ];

    public function up(): void
    {
        foreach ($this->map as $id => [$needle, $url]) {
            $repo = Repo::find($id);
            if ($repo
                && Str::contains($repo->title, $needle)
                && empty($repo->data_link) && empty($repo->en_pdf) && empty($repo->ar_pdf)) {
                $repo->data_link = $url;
                $repo->save();
            }
        }
    }

    public function down(): void
    {
        foreach ($this->map as $id => [$needle, $url]) {
            $repo = Repo::find($id);
            if ($repo && $repo->data_link === $url) {
                $repo->data_link = null;
                $repo->save();
            }
        }
    }
};
