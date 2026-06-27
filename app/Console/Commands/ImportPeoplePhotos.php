<?php

namespace App\Console\Commands;

use App\Models\Community;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Imports People photos from a local folder (e.g. a Google Drive folder
 * downloaded as a ZIP and unpacked on the server) — for when the Drive files
 * can't be fetched anonymously (org sharing policy). Each image is matched to a
 * Community person by filename and copied into the public disk.
 *
 *     php artisan people:import-photos /tmp/people_photos
 *     php artisan people:import-photos /tmp/people_photos --dry-run
 *
 * Filenames just need to contain the person's name (case/spacing/underscores
 * don't matter), e.g. "Ahmad M. Awad.jpg", "ahmad_awad.png".
 */
class ImportPeoplePhotos extends Command
{
    protected $signature = 'people:import-photos {dir : Folder of image files} {--dry-run}';
    protected $description = 'Match a folder of image files to People (Community) records by name and store them';

    public function handle(): int
    {
        $dir = rtrim($this->argument('dir'), '/');
        if (!is_dir($dir)) {
            $this->error("Not a directory: {$dir}");
            return self::FAILURE;
        }
        $dryRun = (bool) $this->option('dry-run');

        $disk = Storage::disk('public');
        $disk->makeDirectory('community_images');

        // Build slug => Community lookup.
        $people = Community::all();
        $bySlug = [];
        foreach ($people as $p) {
            $bySlug[Str::slug($p->name)] = $p;
        }

        $files = [];
        foreach (scandir($dir) as $f) {
            if (in_array(strtolower(pathinfo($f, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp'])) {
                $files[] = $f;
            }
        }

        $matched = 0; $ambiguous = []; $unmatched = [];

        foreach ($files as $file) {
            $base = Str::slug(pathinfo($file, PATHINFO_FILENAME));
            // 1) exact slug; 2) person-slug contained in filename; 3) filename contained in person-slug.
            $hits = [];
            if (isset($bySlug[$base])) {
                $hits[$base] = $bySlug[$base];
            } else {
                foreach ($bySlug as $slug => $person) {
                    if (Str::contains($base, $slug) || Str::contains($slug, $base)) {
                        $hits[$slug] = $person;
                    }
                }
            }

            if (count($hits) === 0) { $unmatched[] = $file; continue; }
            if (count($hits) > 1)  { $ambiguous[$file] = array_map(fn($p) => $p->name, $hits); continue; }

            $person = reset($hits);
            $slug = Str::slug($person->name);
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'jpeg' ? 'jpg' : strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $rel = "community_images/{$slug}.{$ext}";

            $this->line("  {$file}  ->  {$person->name}");
            if (!$dryRun) {
                $disk->put($rel, file_get_contents("{$dir}/{$file}"));
                $person->image = $rel;
                $person->thumbnail_image = $rel;
                $person->save();
            }
            $matched++;
        }

        $without = $people->filter(fn($p) => !$p->thumbnail_image)->pluck('name');

        $this->newLine();
        $this->info(($dryRun ? '[dry-run] ' : '') . "Matched: {$matched}  |  Ambiguous: " . count($ambiguous) . "  |  Unmatched files: " . count($unmatched));
        foreach ($ambiguous as $file => $names) $this->warn("  ambiguous: {$file}  -> " . implode(', ', $names));
        foreach ($unmatched as $file) $this->warn("  no person for file: {$file}");
        if ($without->count()) {
            $this->newLine();
            $this->warn("People still without a photo (" . $without->count() . "): " . $without->implode(', '));
        }

        return self::SUCCESS;
    }
}
