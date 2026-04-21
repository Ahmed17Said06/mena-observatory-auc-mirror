<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blogs;
use Carbon\Carbon;

class LebanonPublicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Adds Lebanon Platform Workers publications to the blogs table.
     */
    public function run(): void
    {
        $lebanon_country_id = 3; // Lebanon country ID

        // Lebanon Platform Workers Report
        Blogs::create([
            'title' => 'New Work: Platform Workers - Case of Lebanon',
            'description' => 'This report examines the conditions of platform workers in Lebanon, exploring their challenges, opportunities, and the policy frameworks needed to protect them in the evolving digital economy. Fieldwork was conducted in Fall/Winter 2023.',
            'content' => '
                <p><strong>New Work: Platform Workers - Case of Lebanon</strong></p>
                <p>This comprehensive report explores the landscape of platform work in Lebanon, examining the conditions faced by workers in the digital economy. The study investigates how platform-mediated work has emerged as a significant form of employment, particularly in the context of Lebanon\'s economic challenges.</p>
                
                <div class="disclaimer-box" style="background: #fff8e6; border-left: 4px solid #FAAF1C; padding: 1rem 1.5rem; margin: 1.5rem 0; border-radius: 0 8px 8px 0;">
                    <strong>Note:</strong> Fieldwork for this report was conducted in Fall/Winter 2023. Analysis and recommendations are based on that timeline.
                </div>
                
                <h3>Key Findings</h3>
                <ul>
                    <li>Platform workers face significant challenges in terms of job security and social protection</li>
                    <li>The regulatory framework in Lebanon has not kept pace with the growth of the gig economy</li>
                    <li>Workers often lack access to basic labor protections and benefits</li>
                </ul>
                
                <h3>Recommendations</h3>
                <p>The report provides actionable policy recommendations aimed at improving conditions for platform workers while supporting the growth of the digital economy in Lebanon.</p>
                
                <p><a href="/docs/lebanon/lebanon-platform-workers-report-en.pdf" target="_blank" class="btn btn-primary">Download Full Report (English)</a></p>
                <p><a href="/docs/lebanon/lebanon-platform-workers-report-ar.pdf" target="_blank" class="btn btn-secondary">تحميل التقرير الكامل (العربية)</a></p>
            ',
            'image' => 'blogs/lebanon-platform-workers.png',
            'publish_date' => Carbon::now(),
            'country_id' => $lebanon_country_id,
            'views' => 0,
        ]);

        // Lebanon Platform Workers Policy Brief
        Blogs::create([
            'title' => 'Policy Brief: Platform Workers - Case of Lebanon',
            'description' => 'This policy brief provides a concise overview of key policy recommendations for improving the conditions of platform workers in Lebanon. Based on fieldwork conducted in Fall/Winter 2023.',
            'content' => '
                <p><strong>Policy Brief: Platform Workers - Case of Lebanon</strong></p>
                <p>This policy brief synthesizes the key findings and recommendations from our comprehensive study on platform workers in Lebanon, providing actionable guidance for policymakers.</p>
                
                <div class="disclaimer-box" style="background: #fff8e6; border-left: 4px solid #FAAF1C; padding: 1rem 1.5rem; margin: 1.5rem 0; border-radius: 0 8px 8px 0;">
                    <strong>Note:</strong> Fieldwork for this research was conducted in Fall/Winter 2023. Analysis and recommendations are based on that timeline.
                </div>
                
                <h3>Policy Recommendations</h3>
                <ul>
                    <li>Establish clear legal frameworks for platform work classification</li>
                    <li>Extend social protection coverage to platform workers</li>
                    <li>Create mechanisms for worker representation and collective bargaining</li>
                    <li>Ensure fair algorithmic management practices</li>
                </ul>
                
                <p><a href="/docs/lebanon/lebanon-platform-workers-policy-brief-en.pdf" target="_blank" class="btn btn-primary">Download Policy Brief (English)</a></p>
                <p><a href="/docs/lebanon/lebanon-platform-workers-policy-brief-ar.pdf" target="_blank" class="btn btn-secondary">تحميل موجز السياسات (العربية)</a></p>
            ',
            'image' => 'blogs/lebanon-policy-brief.png',
            'publish_date' => Carbon::now(),
            'country_id' => $lebanon_country_id,
            'views' => 0,
        ]);

        $this->command->info('Lebanon publications seeded successfully!');
    }
}
