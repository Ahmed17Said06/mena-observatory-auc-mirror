<?php

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Populates thumbnails for image-less News items by scraping the og:image
 * (or twitter:image) from each item's data_link and storing it locally.
 *
 * HTML article links work; PDF links and pages without a social image are
 * skipped. Idempotent: only touches rows whose image is empty (unless --force).
 *
 *     php artisan news:fetch-images
 *     php artisan news:fetch-images --dry-run
 *     php artisan news:fetch-images --force --only=12
 */
class FetchNewsImages extends Command
{
    protected $signature = 'news:fetch-images
        {--dry-run : Report what would be fetched without downloading}
        {--force : Re-fetch even if the item already has an image}
        {--only= : Limit to a single News id}';

    protected $description = 'Fetch og:image thumbnails for image-less news items from their source link';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $force  = (bool) $this->option('force');
        $only   = $this->option('only');

        $disk = Storage::disk('public');
        $disk->makeDirectory('news_images');

        $query = News::query()->whereNotNull('data_link')->where('data_link', '!=', '');
        if ($only) {
            $query->where('id', $only);
        }

        $done = 0;
        $skipped = 0;
        $failed = [];

        foreach ($query->get() as $news) {
            if (!$force && !empty($news->image)) {
                $skipped++;
                continue;
            }

            $link = trim((string) $news->data_link);
            if (!Str::startsWith($link, ['http://', 'https://']) || Str::endsWith(strtolower(parse_url($link, PHP_URL_PATH) ?? ''), '.pdf')) {
                $skipped++;
                continue;
            }

            $this->line("  [{$news->id}] {$news->title}");

            $imageUrl = $this->discoverImageUrl($link);
            if (!$imageUrl) {
                $failed[$news->id] = 'no og:image found';
                $this->warn("      no og:image");
                continue;
            }

            if ($dryRun) {
                $this->line("      would use: {$imageUrl}");
                $done++;
                continue;
            }

            $stored = $this->downloadImage($imageUrl, $disk);
            if (!$stored) {
                $failed[$news->id] = 'image download failed';
                $this->error("      download failed: {$imageUrl}");
                continue;
            }

            $news->image = $stored;
            $news->save();
            $done++;
            $this->info("      saved {$stored}");
        }

        $this->newLine();
        $this->info(($dryRun ? '[dry-run] ' : '') . "Fetched: {$done}  |  Skipped: {$skipped}  |  Failed: " . count($failed));
        foreach ($failed as $id => $why) {
            $this->warn("  - news #{$id}: {$why}");
        }

        return self::SUCCESS;
    }

    /** Fetch the page and extract an og:image / twitter:image URL (absolute). */
    private function discoverImageUrl(string $pageUrl): ?string
    {
        // YouTube links have no scrapable og:image on the watch page; use the
        // video's generated thumbnail directly (hqdefault always exists).
        if (preg_match('~(?:youtube\.com/(?:watch\?v=|embed/)|youtu\.be/)([A-Za-z0-9_-]{11})~', $pageUrl, $yt)) {
            return 'https://img.youtube.com/vi/' . $yt[1] . '/hqdefault.jpg';
        }

        try {
            $res = Http::withHeaders(['User-Agent' => 'Mozilla/5.0 (compatible; MENAObservatoryBot/1.0)'])
                ->withOptions(['verify' => false, 'allow_redirects' => true])
                ->timeout(20)
                ->get($pageUrl);
        } catch (\Throwable $e) {
            return null;
        }

        if (!$res->successful()) {
            return null;
        }
        $html = $res->body();

        $patterns = [
            '~<meta[^>]+(?:property|name)=["\']og:image(?::secure_url)?["\'][^>]+content=["\']([^"\']+)["\']~i',
            '~<meta[^>]+content=["\']([^"\']+)["\'][^>]+(?:property|name)=["\']og:image["\']~i',
            '~<meta[^>]+(?:property|name)=["\']twitter:image(?::src)?["\'][^>]+content=["\']([^"\']+)["\']~i',
            '~<link[^>]+rel=["\']image_src["\'][^>]+href=["\']([^"\']+)["\']~i',
        ];
        foreach ($patterns as $p) {
            if (preg_match($p, $html, $m)) {
                return $this->absoluteUrl(html_entity_decode(trim($m[1])), $pageUrl);
            }
        }
        return null;
    }

    /** Resolve a possibly-relative image URL against the page URL. */
    private function absoluteUrl(string $url, string $base): ?string
    {
        if ($url === '') {
            return null;
        }
        if (Str::startsWith($url, '//')) {
            return 'https:' . $url;
        }
        if (Str::startsWith($url, ['http://', 'https://'])) {
            return $url;
        }
        $parts = parse_url($base);
        if (!isset($parts['scheme'], $parts['host'])) {
            return null;
        }
        $origin = $parts['scheme'] . '://' . $parts['host'];
        return $origin . '/' . ltrim($url, '/');
    }

    /** Download an image to the public disk; returns the relative path or null. */
    private function downloadImage(string $url, $disk): ?string
    {
        try {
            $res = Http::withHeaders(['User-Agent' => 'Mozilla/5.0'])
                ->withOptions(['verify' => false, 'allow_redirects' => true])
                ->timeout(30)
                ->get($url);
        } catch (\Throwable $e) {
            return null;
        }

        if (!$res->successful()) {
            return null;
        }
        $body = $res->body();
        if (strlen($body) < 2000) {
            return null; // too small to be a real image
        }

        $type = strtolower($res->header('Content-Type') ?? '');
        $ext = match (true) {
            str_contains($type, 'png')  => 'png',
            str_contains($type, 'webp') => 'webp',
            str_contains($type, 'gif')  => 'gif',
            str_contains($type, 'svg')  => 'svg',
            default                      => 'jpg',
        };

        $path = 'news_images/' . sha1($url) . '.' . $ext;
        $disk->put($path, $body);
        return $path;
    }
}
