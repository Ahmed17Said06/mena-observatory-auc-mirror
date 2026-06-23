<?php

namespace Database\Seeders;

use App\Models\Aswat;
use Illuminate\Database\Seeder;

/**
 * Rename the Aswat interview videos to their full titles. Idempotent:
 * matches the current title exactly; once renamed, re-running is a no-op.
 * Prints how many rows each mapping matched, then lists every Aswat row so
 * any unmatched/variant titles can be spotted and corrected.
 *
 *   php artisan db:seed --class=RenameAswatInterviewsSeeder --force
 */
class RenameAswatInterviewsSeeder extends Seeder
{
    public function run(): void
    {
        $map = [
            'Interview with Dr' => 'Interview with Dr. Marwa Seoudi',
            'Interview 1'       => 'Interview 1 with Zaher AI',
            'Interview 2'       => 'Interview 2 with Synqanun',
            'Interview 3'       => 'Interview 3 with AgriCan',
            'Interview 4'       => 'Interview 4 with Cloudilic',
            'Interview 5'       => 'Interview 5 with Rology',
        ];

        foreach ($map as $old => $new) {
            $matched = Aswat::where('title', $old)->update(['title' => $new]);
            $this->command->line(sprintf('  "%s" → "%s"  (%d row%s)', $old, $new, $matched, $matched === 1 ? '' : 's'));
        }

        $this->command->line('');
        $this->command->info('All Aswat rows now:');
        foreach (Aswat::orderBy('id')->get(['id', 'title']) as $a) {
            $this->command->line(sprintf('  #%d  %s', $a->id, $a->title));
        }
    }
}
