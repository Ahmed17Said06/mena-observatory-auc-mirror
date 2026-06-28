<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Imports the "People and Partners" sheet (exported to assets/people.json) into
 * the Community (People) page. Each person's photo is pulled from its Google
 * Drive link and stored locally (same Drive-download approach as the Aswat
 * thumbnail command).
 *
 * Match key: name. The sheet is treated as the source of truth, so a present
 * short bio / full bio / photo overwrites the existing value; blank cells are
 * left untouched so name-only rows never wipe an existing bio.
 *
 *     php artisan db:seed --class=Database\\Seeders\\ImportPeopleSeeder --force
 */
class ImportPeopleSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/assets/people.json');
        if (!is_file($path)) {
            $this->command->error("Missing {$path}");
            return;
        }

        $people = json_decode(file_get_contents($path), true) ?: [];
        $disk = Storage::disk('public');
        $disk->makeDirectory('community_images');

        $created = 0; $updated = 0; $withPhoto = 0; $photoFailed = [];

        foreach ($people as $p) {
            $name  = trim($p['name'] ?? '');
            if ($name === '') continue;
            $short = trim($p['short'] ?? '');
            $full  = trim($p['full'] ?? '');
            $id    = trim($p['drive_id'] ?? '');

            $c = Community::firstOrNew(['name' => $name]);
            $existed = $c->exists;

            // Overwrite with sheet data, but only when the sheet actually has it.
            if ($short !== '') $c->description = $short;
            if ($full  !== '') $c->content     = $full;

            // Photo: prefer a committed local asset (extracted from the supplied
            // photo set); fall back to downloading from the Drive link.
            $slug = Str::slug($name);
            $rel = $this->installAssetPhoto($slug, $disk)
                ?: ($id !== '' ? $this->fetchDrivePhoto($id, $slug, $disk) : null);
            if ($rel) {
                $c->image = $rel;
                $c->thumbnail_image = $rel;
                $withPhoto++;
            } elseif ($id !== '') {
                $photoFailed[] = $name;
            }

            // NOT NULL columns must always have a value on insert.
            $c->description     = $c->description ?? '';
            $c->content         = $c->content ?? '';
            $c->thumbnail_image = $c->thumbnail_image ?? '';

            $c->save();
            $existed ? $updated++ : $created++;
            $this->command->line("  " . ($existed ? 'updated' : 'created') . ": {$name}");
        }

        $this->command->newLine();
        $this->command->info("Created: {$created}  |  Updated: {$updated}  |  Photos: {$withPhoto}  |  Photo failed: " . count($photoFailed));
        foreach ($photoFailed as $n) $this->command->warn("  - no photo: {$n}");
    }

    /** Copy a committed asset photo (assets/community_photos/<slug>.jpg) to the public disk. */
    private function installAssetPhoto(string $slug, $disk): ?string
    {
        $src = database_path("seeders/assets/community_photos/{$slug}.jpg");
        if (!is_file($src)) return null;
        $rel = "community_images/{$slug}.jpg";
        $disk->put($rel, file_get_contents($src));
        return $rel;
    }

    /** Download a Drive image to community_images/<slug>.<ext>; returns rel path or null. */
    private function fetchDrivePhoto(string $id, string $slug, $disk): ?string
    {
        // Reuse an already-downloaded, reasonably-sized photo (idempotent re-runs).
        // Anything oversized (a full-res original) is dropped so we re-fetch a
        // web-sized version below.
        foreach (['jpg', 'png', 'webp', 'jpeg'] as $ext) {
            $rel = "community_images/{$slug}.{$ext}";
            if ($disk->exists($rel)) {
                $sz = $disk->size($rel);
                if ($sz > 2000 && $sz < 3_000_000) return $rel;
                $disk->delete($rel);
            }
        }

        // Prefer Drive's thumbnail endpoint (returns a web-sized JPEG for public
        // files); fall back to the full-file download endpoint.
        $urls = [
            "https://drive.google.com/thumbnail?id={$id}&sz=w1200",
            "https://drive.usercontent.google.com/download?id={$id}&export=download&confirm=t",
        ];
        foreach ($urls as $url) {
            try {
                $res = Http::withHeaders(['User-Agent' => 'Mozilla/5.0'])
                    ->withOptions(['verify' => false, 'allow_redirects' => true])
                    ->timeout(60)->get($url);
            } catch (\Throwable $e) {
                continue;
            }
            if (!$res->successful()) continue;

            $body = $res->body();
            $type = strtolower($res->header('Content-Type') ?? '');
            // A private file returns the Google sign-in HTML page — skip it.
            if (!Str::startsWith($type, 'image/') || strlen($body) < 2000) continue;

            $ext = match (true) {
                str_contains($type, 'png')  => 'png',
                str_contains($type, 'webp') => 'webp',
                default                      => 'jpg',
            };
            $rel = "community_images/{$slug}.{$ext}";
            $disk->put($rel, $body);
            return $rel;
        }
        return null;
    }
}
