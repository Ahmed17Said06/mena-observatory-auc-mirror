<?php

namespace App\Console\Commands;

use App\Models\Repo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Generates cover images for Knowledge Hub resources (repo rows) that have no
 * `image`, using each item's own material:
 *
 *   1. A stored PDF (en_pdf / ar_pdf / first pdfFiles entry) → render page 1
 *      with poppler's `pdftoppm` (same look as a uploaded PDF-first-page cover).
 *   2. Otherwise an external HTML link (data_link) → scrape its og:image.
 *
 * Idempotent: only fills rows whose `image` is empty (unless --force) and writes
 * a deterministic repo_covers/<id>.jpg. Covers stay overridable in Filament.
 *
 * Requires `pdftoppm` for the PDF path:  sudo apt-get install -y poppler-utils
 *
 *     php artisan repos:fetch-covers --dry-run
 *     php artisan repos:fetch-covers
 *     php artisan repos:fetch-covers --only=42 --force
 *     php artisan repos:fetch-covers --source=link
 */
class FetchRepoCovers extends Command
{
    protected $signature = 'repos:fetch-covers
        {--dry-run : Report what would be generated without writing}
        {--force : Re-generate even if the item already has an image}
        {--only= : Limit to a single Repo id}
        {--source=all : Which sources to use: all|pdf|link}';

    protected $description = 'Generate cover images for image-less Knowledge Hub resources (PDF first page or og:image)';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $force  = (bool) $this->option('force');
        $only   = $this->option('only');
        $source = in_array($this->option('source'), ['all', 'pdf', 'link'], true)
            ? $this->option('source') : 'all';

        $hasPoppler = $this->binaryExists('pdftoppm');
        if (($source === 'all' || $source === 'pdf') && ! $hasPoppler) {
            $this->warn("pdftoppm not found — PDF covers will be skipped. Install with: sudo apt-get install -y poppler-utils");
        }

        $disk = Storage::disk('public');
        $disk->makeDirectory('repo_covers');

        $query = Repo::query()->with('pdfFiles');
        if ($only) {
            $query->where('id', $only);
        }

        $done = 0;
        $skipped = 0;
        $failed = [];

        foreach ($query->get() as $repo) {
            if (! $force && ! empty($repo->image)) {
                $skipped++;
                continue;
            }

            $this->line("  [{$repo->id}] {$repo->title}");

            $stored = null;

            // 1) PDF first page
            if (($source === 'all' || $source === 'pdf') && $hasPoppler) {
                if ($pdf = $this->resolvePdf($repo)) {
                    if ($dryRun) {
                        $this->line("      would render PDF page 1: {$pdf['label']}");
                        $done++;
                        continue;
                    }
                    $stored = $this->renderPdfCover($pdf['path'], $pdf['cleanup'], $repo->id, $disk);
                    if (! $stored) {
                        $this->warn("      pdf render failed: {$pdf['label']}");
                    }
                }
            }

            // 2) og:image from external link
            if (! $stored && ($source === 'all' || $source === 'link')) {
                $link = trim((string) $repo->data_link);
                $isHtml = Str::startsWith($link, ['http://', 'https://'])
                    && ! Str::endsWith(strtolower(parse_url($link, PHP_URL_PATH) ?? ''), '.pdf');
                if ($isHtml) {
                    $imageUrl = $this->discoverImageUrl($link);
                    if ($imageUrl) {
                        if ($dryRun) {
                            $this->line("      would scrape og:image: {$imageUrl}");
                            $done++;
                            continue;
                        }
                        $stored = $this->downloadImage($imageUrl, $disk);
                        if (! $stored) {
                            $this->warn("      og:image download failed: {$imageUrl}");
                        }
                    }
                }
            }

            if (! $stored) {
                if (! $dryRun) {
                    $failed[$repo->id] = 'no usable PDF or og:image';
                }
                $skipped++;
                continue;
            }

            $repo->image = $stored;
            $repo->save();
            $done++;
            $this->info("      saved {$stored}");
        }

        $this->newLine();
        $this->info(($dryRun ? '[dry-run] ' : '') . "Generated: {$done}  |  Skipped: {$skipped}  |  Failed: " . count($failed));
        foreach ($failed as $id => $why) {
            $this->warn("  - repo #{$id}: {$why}");
        }

        return self::SUCCESS;
    }

    /** Is a CLI binary available on the host? */
    private function binaryExists(string $bin): bool
    {
        exec('command -v ' . escapeshellarg($bin) . ' 2>/dev/null', $o, $code);
        return $code === 0;
    }

    /**
     * Find the first usable PDF for a repo and resolve it to a local absolute
     * path. Returns ['path'=>abs, 'label'=>orig, 'cleanup'=>?tmpToUnlink] or null.
     */
    private function resolvePdf(Repo $repo): ?array
    {
        $candidates = array_filter([
            $repo->en_pdf,
            $repo->ar_pdf,
            optional($repo->pdfFiles->first())->file,
            // External resources are often linked as a direct PDF URL — render
            // its first page too (non-.pdf links fall through to og:image below).
            $repo->data_link,
        ]);

        foreach ($candidates as $p) {
            $p = trim((string) $p);
            if ($p === '' || ! Str::endsWith(strtolower(parse_url($p, PHP_URL_PATH) ?? $p), '.pdf')) {
                continue;
            }

            // Remote PDF: download to temp.
            if (Str::startsWith($p, ['http://', 'https://'])) {
                $tmp = tempnam(sys_get_temp_dir(), 'repopdf_') . '.pdf';
                try {
                    $res = Http::withHeaders(['User-Agent' => 'Mozilla/5.0'])
                        ->withOptions(['verify' => false, 'allow_redirects' => true])
                        ->timeout(40)->get($p);
                } catch (\Throwable $e) {
                    @unlink($tmp);
                    continue;
                }
                if (! $res->successful() || strlen($res->body()) < 1000) {
                    @unlink($tmp);
                    continue;
                }
                file_put_contents($tmp, $res->body());
                return ['path' => $tmp, 'label' => $p, 'cleanup' => $tmp];
            }

            // Local PDF: /docs/... lives under public/, others on the public disk.
            $abs = Str::startsWith($p, '/')
                ? public_path(ltrim($p, '/'))
                : Storage::disk('public')->path($p);

            if (is_file($abs)) {
                return ['path' => $abs, 'label' => $p, 'cleanup' => null];
            }
        }

        return null;
    }

    /** Render page 1 of a PDF to repo_covers/<id>.jpg. Returns relative path or null. */
    private function renderPdfCover(string $pdfPath, ?string $cleanup, int $id, $disk): ?string
    {
        $rel = 'repo_covers/' . $id . '.jpg';
        $finalAbs = $disk->path($rel);
        $prefix = sys_get_temp_dir() . '/repocover_' . $id;

        // pdftoppm appends "-1"/"-01"/... to the prefix.
        $cmd = sprintf(
            'pdftoppm -jpeg -f 1 -l 1 -scale-to 1000 %s %s',
            escapeshellarg($pdfPath),
            escapeshellarg($prefix)
        );
        exec($cmd . ' 2>&1', $out, $code);

        if ($cleanup) {
            @unlink($cleanup);
        }

        $generated = glob($prefix . '-*.jpg') ?: [];
        if ($code !== 0 || empty($generated) || ! is_file($generated[0]) || filesize($generated[0]) < 2000) {
            foreach ($generated as $g) {
                @unlink($g);
            }
            return null;
        }

        @rename($generated[0], $finalAbs);
        foreach (array_slice($generated, 1) as $g) {
            @unlink($g);
        }

        return is_file($finalAbs) ? $rel : null;
    }

    /** Fetch the page and extract an og:image / twitter:image URL (absolute). */
    private function discoverImageUrl(string $pageUrl): ?string
    {
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

        if (! $res->successful()) {
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
        if (! isset($parts['scheme'], $parts['host'])) {
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

        if (! $res->successful()) {
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

        $path = 'repo_covers/' . sha1($url) . '.' . $ext;
        $disk->put($path, $body);
        return $path;
    }
}
