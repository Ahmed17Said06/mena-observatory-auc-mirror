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

            // Photo from Drive (skip re-download if we already have it locally).
            if ($id !== '') {
                $rel = $this->fetchDrivePhoto($id, Str::slug($name), $disk);
                if ($rel) {
                    $c->image = $rel;
                    $c->thumbnail_image = $rel;
                    $withPhoto++;
                } else {
                    $photoFailed[] = $name;
                }
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

    /** Download a Drive image to community_images/<slug>.<ext>; returns rel path or null. */
    private function fetchDrivePhoto(string $id, string $slug, $disk): ?string
    {
        // Reuse an already-downloaded photo (idempotent re-runs).
        foreach (['jpg', 'png', 'webp', 'jpeg'] as $ext) {
            $rel = "community_images/{$slug}.{$ext}";
            if ($disk->exists($rel) && $disk->size($rel) > 2000) return $rel;
        }

        $url = "https://drive.usercontent.google.com/download?id={$id}&export=download&confirm=t";
        try {
            $res = Http::withHeaders(['User-Agent' => 'Mozilla/5.0'])
                ->withOptions(['verify' => false, 'allow_redirects' => true])
                ->timeout(60)->get($url);
        } catch (\Throwable $e) {
            return null;
        }
        if (!$res->successful()) return null;

        $body = $res->body();
        $type = strtolower($res->header('Content-Type') ?? '');
        if (!Str::startsWith($type, 'image/') || strlen($body) < 2000) return null;

        $ext = match (true) {
            str_contains($type, 'png')  => 'png',
            str_contains($type, 'webp') => 'webp',
            default                      => 'jpg',
        };
        $rel = "community_images/{$slug}.{$ext}";
        $disk->put($rel, $body);
        return $rel;
    }
}
