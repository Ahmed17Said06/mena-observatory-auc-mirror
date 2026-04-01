<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use Illuminate\Support\Facades\DB;

class RaiCupNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Add the RAI Cup Awards Ceremony news article
     *
     * @return void
     */
    public function run()
    {
        // English content
        $englishTitle = "The Access to Knowledge for Development Center at The American University in Cairo Hosts the Responsible AI Cup Awards Ceremony Under the Patronage of the Ministry of Communications and Information Technology (MCIT)";
        
        $englishDescription = "The American University in Cairo (AUC) represented by Access to Knowledge for Development (A2K4D) at Onsi Sawiris School of Business will host the Inaugural Responsible AI Cup Awards Ceremony on Sunday, January 18, 2026.";
        
        $englishContent = <<<EOT
<p>The American University in Cairo (AUC) represented by Access to Knowledge for Development (A2K4D) at Onsi Sawiris School of Business will host the Inaugural Responsible AI Cup Awards Ceremony on Sunday, January 18, 2026, at Founders Spaces, Downtown Cairo. The event is held under the patronage of the Ministry of Communications and Information Technology (MCIT) and marks the conclusion of the Responsible AI (RAI) Cup competition, while also celebrating the 16th anniversary of Access to Knowledge for Development (A2K4D) Center. The RAI competition is an initiative of A2K4D's flagship MENA Observatory on Responsible AI, advocating for responsible AI policies and practices across the MENA region.</p>

<p>The RAI Cup competition was launched in October 2025 as the first competition in Egypt for Small and Medium Enterprises (SMEs) and startups building or using artificial intelligence (AI) in their tech solutions, with a primary focus on fostering responsible AI themes and practices. The competition brought together submissions from 41 companies demonstrating their commitment to responsible AI across nine pillars: privacy, accountability, safety, transparency, fairness, human oversight, professional responsibility and human values.</p>

<p>The submissions were then evaluated and the top five participants were selected to showcase their pitches on the upcoming awards ceremony day. The companies that qualified to this final stage are: <strong>Rology, Cloudilic, AgriCan, Cluster and Zaher AI</strong>. The first, second and third places will receive financial awards from A2K4D, and the fourth and fifth places will receive honorary awards.</p>

<p>The RAI Cup aims at incentivizing SMEs and startups in Egypt and the MENA region, to implement responsible AI and recognize responsible practices that are already in place. It also seeks to raise awareness about ethical, legal and environmental implications of AI. The RAI Cup provides a space for entrepreneurs to collaborate with each other, as well as with experts from academia and the AI ecosystem. Grounded in capacity building, the RAI Cup competition gave participants the opportunity to grow their skills through educational content and training in responsible AI.</p>

<p>The ceremony will bring together prominent figures from the AI startup ecosystem, experienced judges and invited guests from the MENA Observatory on Responsible AI, alongside members of A2K4D's regional and international networks. The event aims to highlight innovative approaches to responsible and ethical artificial intelligence while fostering dialogue among policymakers, practitioners and innovators.</p>

<p>The program will feature finalist pitches from the Responsible AI Cup, followed by the announcement of award recipients in recognition of exceptional approaches to responsible AI. The event will also include an engaging discussion on responsible AI and conclude with a reflection on A2K4D's achievements and impact in 2025.</p>

<h3>The panel of judges for the final pitches includes:</h3>
<ul>
<li><strong>Hoda Baraka</strong>, Advisor to Minister of Communications and Information Technology and professor of computer engineering, Cairo University</li>
<li><strong>Nezar Sami</strong>, skills development analyst, Regional Programme for Arab States (RBAS), Regional Programme Division, United Nations Development Programme UNDP</li>
<li><strong>Ayman Ismail</strong>, Abdul Latif Jameel Endowed Chair of Entrepreneurship, associate professor, Onsi Sawiris School of Business, and founding director of AUC Venture Lab, The American University in Cairo</li>
<li><strong>Lamiaa El Rashidi</strong>, senior manager, Incubation Department, Technology Innovation and Entrepreneurship Center (TIEC)</li>
</ul>

<p>By convening key stakeholders from academia, government and the private sector, the Responsible AI Cup Awards Ceremony underscores AUC's and A2K4D's commitment to advancing responsible AI practices and supporting innovation that aligns with societal values and inclusive development.</p>
EOT;

        // Check if this news already exists
        $existingNews = News::where('title', 'like', '%Responsible AI Cup Awards%')->first();
        
        if (!$existingNews) {
            News::create([
                'title' => $englishTitle,
                'description' => $englishDescription,
                'content' => $englishContent,
                'date' => '2026-01-18',
                'image' => 'uploads/news/rai-cup-ceremony.jpg', // You may need to upload an image
                'featured' => 'yes',
                'country_id' => 5, // Egypt
                'views' => 0
            ]);
            
            $this->command->info('RAI Cup Awards Ceremony news article has been added successfully!');
        } else {
            $this->command->info('RAI Cup Awards Ceremony news article already exists.');
        }
    }
}