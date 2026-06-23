<?php

namespace Database\Seeders;

use App\Models\Aswat;
use Illuminate\Database\Seeder;

/**
 * Rename the Aswat interview videos to their full titles. Keyed by id
 * (the live titles were "Interview — Dr." / "Interview One…Five", so a
 * title match was unreliable). Idempotent: re-running just re-sets the
 * same titles. Prints every Aswat row afterward for verification.
 *
 *   php artisan db:seed --class=RenameAswatInterviewsSeeder --force
 */
class RenameAswatInterviewsSeeder extends Seeder
{
    public function run(): void
    {
        // id => new title  (current title shown for reference)
        $map = [
            53 => 'RAI Cup Awards & 16 Years of A2K4D', // was "AUC AI Event"
            54 => 'Interview with Dr. Marwa Seoudi', // was "Interview — Dr."
            55 => 'Interview 1 with Zaher AI',        // was "Interview One"
            56 => 'Interview 2 with Synqanun',        // was "Interview Two"
            57 => 'Interview 3 with AgriCan',         // was "Interview Three"
            58 => 'Interview 4 with Cloudilic',       // was "Interview Four"
            59 => 'Interview 5 with Rology',          // was "Interview Five"
        ];

        foreach ($map as $id => $new) {
            $aswat = Aswat::find($id);
            if (! $aswat) {
                $this->command->warn("  #{$id} not found — skipped");
                continue;
            }
            $old = $aswat->title;
            $aswat->title = $new;
            $aswat->save();
            $this->command->line(sprintf('  #%d  "%s" → "%s"', $id, $old, $new));
        }

        $this->command->line('');
        $this->command->info('All Aswat rows now:');
        foreach (Aswat::orderBy('id')->get(['id', 'title']) as $a) {
            $this->command->line(sprintf('  #%d  %s', $a->id, $a->title));
        }
    }
}
