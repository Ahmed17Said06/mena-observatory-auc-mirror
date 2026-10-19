<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Repo;
use App\Models\Repo_tags;
use App\Models\Repo_type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Publishes the rows of "Research and News.xlsx" (October 2026 edition) that
 * were not yet on the site, from seeders/assets/research_and_news_2026_10.json:
 *   - news     → News, featured='global_ai' (Global AI News on /news)
 *   - regional → Repo, is_global=false (Knowledge Hub › Regional Resources)
 *   - global   → Repo, is_global=true  (Knowledge Hub › Global Resources)
 *
 * Follows ResearchAndNewsImportSeeder: the institution is the description,
 * repo_type is derived from tags/title, missing tags are created. Rows already
 * on the site (matched by title, then by link) are skipped untouched, so
 * re-running is safe. Covers/thumbnails come afterwards from
 * `repos:fetch-covers` and `news:fetch-images`.
 *
 *     sudo -u www-data php artisan db:seed --class=Database\\Seeders\\ResearchAndNewsOct2026Seeder --force
 */
class ResearchAndNewsOct2026Seeder extends Seeder
{
    private array $created = ['news' => 0, 'regional' => 0, 'global' => 0];
    private array $skipped = ['news' => 0, 'regional' => 0, 'global' => 0];

    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seeders/assets/research_and_news_2026_10.json')), true);

        foreach ($data['news'] as $n) {
            $this->addNews($n);
        }
        foreach ($data['regional'] as $r) {
            $this->addRepo($r, false);
        }
        foreach ($data['global'] as $r) {
            $this->addRepo($r, true);
        }

        foreach ($this->created as $kind => $count) {
            $this->command->info(sprintf('%-8s created: %3d   already on site: %3d', $kind, $count, $this->skipped[$kind]));
        }
        $this->command->comment('Next: php artisan repos:fetch-covers && php artisan news:fetch-images');
    }

    private function addNews(array $n): void
    {
        if (News::where('title', $n['title'])->orWhere('data_link', $n['link'])->exists()) {
            $this->skipped['news']++;
            return;
        }

        News::create([
            'title'       => $n['title'],
            'description' => 'Source: ' . $n['source'],
            'content'     => '',
            'image'       => '',
            'date'        => $n['date'],
            'data_link'   => $n['link'],
            'featured'    => 'global_ai',
        ]);
        $this->created['news']++;
    }

    private function addRepo(array $r, bool $isGlobal): void
    {
        $kind = $isGlobal ? 'global' : 'regional';

        if (Repo::where('title', $r['title'])->orWhere('data_link', $r['link'])->exists()) {
            $this->skipped[$kind]++;
            return;
        }

        $repo = new Repo();
        $repo->title        = $r['title'];
        $repo->description  = $r['institution'];
        $repo->publish_date = $r['date'];
        $repo->data_link    = $r['link'];
        $repo->is_global    = $isGlobal;
        $repo->is_our_work  = false;   // schema defaults to 1 — must be explicit
        $repo->repo_type_id = $this->typeIdFor($r['tags'], $r['title']);
        $repo->image        = '';      // NOT NULL; repos:fetch-covers fills it
        $repo->save();

        $tagIds = [];
        foreach ($r['tags'] as $name) {
            $tag = Repo_tags::whereRaw('LOWER(name) = ?', [Str::lower($name)])->first()
                ?? Repo_tags::create(['name' => $name]);
            $tagIds[] = $tag->id;
        }
        $repo->tags()->syncWithoutDetaching($tagIds);

        $this->created[$kind]++;
    }

    /** Same auto-categorisation as ResearchAndNewsImportSeeder. */
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
}
