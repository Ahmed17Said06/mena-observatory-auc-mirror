<?php

namespace App\Console\Commands;

use App\Models\Aswat;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * Generates real thumbnails for Google-Drive-hosted aswat videos by
 * downloading each file and extracting a representative frame with ffmpeg
 * (the Drive thumbnail endpoint only returns the first frame, which is black
 * for clips that fade in). Idempotent and re-runnable.
 *
 * Requires `curl` and `ffmpeg` on the host:
 *     sudo apt-get install -y ffmpeg
 *
 *     php artisan aswat:extract-thumbs                 # all Drive aswats
 *     php artisan aswat:extract-thumbs --only=<fileid> # one
 *     php artisan aswat:extract-thumbs --force         # re-extract even if present
 */
class ExtractAswatThumbnails extends Command
{
    protected $signature = 'aswat:extract-thumbs
        {--only= : Limit to a single Drive file id}
        {--force : Re-extract even if a local thumbnail already exists}
        {--frames=300 : How many frames ffmpeg analyses to pick a representative one}';

    protected $description = 'Download Drive aswat videos and extract a real thumbnail frame with ffmpeg';

    public function handle(): int
    {
        foreach (['curl', 'ffmpeg'] as $bin) {
            exec('command -v ' . $bin . ' 2>/dev/null', $o, $code);
            if ($code !== 0) {
                $this->error("Required binary '{$bin}' not found. Install it (e.g. sudo apt-get install -y ffmpeg).");
                return self::FAILURE;
            }
        }

        $only   = $this->option('only');
        $force  = (bool) $this->option('force');
        $frames = max(1, (int) $this->option('frames'));

        $disk    = Storage::disk('public');
        $thumbDir = 'aswat_thumbs';
        $disk->makeDirectory($thumbDir);

        $aswats = Aswat::where('link', 'like', '%drive.google.com/file/d/%')->get();

        $done = 0;
        $skipped = 0;
        $failed = [];

        foreach ($aswats as $a) {
            if (!preg_match('~drive\.google\.com/file/d/([A-Za-z0-9_-]+)~', $a->link, $m)) {
                continue;
            }
            $id = $m[1];
            if ($only && $id !== $only) {
                continue;
            }

            $thumbRel = $thumbDir . '/' . $id . '.jpg';
            $thumbAbs = $disk->path($thumbRel);

            if (!$force && $a->thumbnail_image === $thumbRel && $disk->exists($thumbRel) && filesize($thumbAbs) > 15000) {
                $this->line("  skip (already good): {$a->title}");
                $skipped++;
                continue;
            }

            $this->line("  processing: {$a->title}  ({$id})");

            $tmpVideo = sys_get_temp_dir() . '/aswat_' . $id . '.m4v';
            $url = 'https://drive.usercontent.google.com/download?id=' . $id . '&export=download&confirm=t';

            // Download the video (curl handles redirects + the confirm page).
            $dl = sprintf(
                'curl -sL -A %s -o %s %s',
                escapeshellarg('Mozilla/5.0'),
                escapeshellarg($tmpVideo),
                escapeshellarg($url)
            );
            exec($dl . ' 2>&1', $dlOut, $dlCode);

            if ($dlCode !== 0 || !is_file($tmpVideo) || filesize($tmpVideo) < 100000) {
                $failed[$id] = 'download failed (' . (is_file($tmpVideo) ? filesize($tmpVideo) . ' bytes' : 'no file') . ')';
                $this->error("    download failed");
                @unlink($tmpVideo);
                continue;
            }

            // Pick a representative frame (avoids black fade-in frames) and scale.
            $ff = sprintf(
                'ffmpeg -y -i %s -vf %s -frames:v 1 -q:v 3 %s',
                escapeshellarg($tmpVideo),
                escapeshellarg('thumbnail=' . $frames . ',scale=1000:-1'),
                escapeshellarg($thumbAbs)
            );
            exec($ff . ' 2>&1', $ffOut, $ffCode);
            @unlink($tmpVideo);

            if ($ffCode !== 0 || !is_file($thumbAbs) || filesize($thumbAbs) < 5000) {
                $failed[$id] = 'ffmpeg failed';
                $this->error("    ffmpeg failed");
                continue;
            }

            $a->thumbnail_image = $thumbRel;
            $a->save();
            $done++;
            $this->info("    saved {$thumbRel} (" . filesize($thumbAbs) . " bytes)");
        }

        $this->newLine();
        $this->info("Extracted: {$done}  |  Skipped: {$skipped}  |  Failed: " . count($failed));
        foreach ($failed as $id => $why) {
            $this->warn("  - {$id}: {$why}");
        }

        return self::SUCCESS;
    }
}
