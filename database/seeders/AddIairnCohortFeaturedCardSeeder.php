<?php

namespace Database\Seeders;

use App\Models\FeaturedInitiativeCard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Adds the "IAIRN MENA Hub Cohort" announcement to the home-page Featured
 * section, linking to the news page at /news/iairn-cohort, and puts it first.
 * Keyed on the route name, so re-running is idempotent; the branded cover
 * (committed under seeders/assets/featured) is installed onto the public disk
 * unless an image was already uploaded through Filament. Run as the web user
 * so the cover can be written:
 *
 *     sudo -u www-data php artisan db:seed --class=Database\Seeders\AddIairnCohortFeaturedCardSeeder --force
 */
class AddIairnCohortFeaturedCardSeeder extends Seeder
{
    public function run(): void
    {
        $card = FeaturedInitiativeCard::firstOrNew(['link' => 'news.iairn-cohort']);

        $card->fill([
            'label_en'       => 'Inclusive AI Research Network',
            'sub_label_en'   => 'MENA Hub Cohort',
            'title_en'       => 'Announcing the IAIRN MENA Hub Cohort',
            'link_external'  => false,
            'button_text_en' => 'Read More',
            'button_text_ar' => 'اقرأ المزيد',
            'button_icon'    => 'fa-plus',
            'is_active'      => true,
        ]);

        // Newest announcement leads the section.
        if (! $card->exists) {
            $card->sort_order = (int) FeaturedInitiativeCard::min('sort_order') - 1;
        }

        if (! $card->image) {
            $disk = Storage::disk('public');
            $rel  = 'featured/iairn-cohort.jpg';
            $src  = database_path('seeders/assets/featured/iairn-cohort.jpg');
            if ($disk->put($rel, file_get_contents($src))) {
                $card->image = $rel;
            } else {
                // The public disk swallows write failures (no 'throw'), so
                // surface them: usually a permissions issue when artisan is
                // not run as the web user.
                $this->command->error("  Could not write {$disk->path($rel)} — run as the web user (e.g. sudo -u www-data).");
            }
        }

        $card->save();

        $this->command->info('IAIRN cohort featured card: ' . ($card->wasRecentlyCreated ? 'created' : 'updated')
            . " (sort_order {$card->sort_order})" . ($card->image ? '' : '  (cover NOT installed)'));
    }
}
