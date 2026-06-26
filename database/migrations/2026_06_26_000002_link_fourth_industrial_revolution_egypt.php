<?php

use App\Models\Repo;
use Illuminate\Database\Migrations\Migration;

/**
 * Attach the missing source for the Knowledge Hub item "The Fourth Industrial
 * Revolution, Artificial Intelligence, and the Future of Work in Egypt"
 * (Rizk & Ismail) — it had no file/link, so the detail page showed nothing to
 * view. Points data_link at the official ILO-hosted PDF so "View Source" works
 * and `repos:fetch-covers` can render a cover from page 1.
 *
 * Guarded by id + title so it no-ops on any DB where the row differs/absent.
 */
return new class extends Migration
{
    private string $pdf = 'https://www.ilo.org/sites/default/files/wcmsp5/groups/public/@africa/@ro-abidjan/@sro-cairo/documents/publication/wcms_821305.pdf';

    public function up(): void
    {
        $repo = Repo::find(104);
        if ($repo
            && str_contains($repo->title, 'Fourth Industrial Revolution')
            && empty($repo->data_link) && empty($repo->en_pdf)) {
            $repo->data_link = $this->pdf;
            $repo->save();
        }
    }

    public function down(): void
    {
        $repo = Repo::find(104);
        if ($repo && $repo->data_link === $this->pdf) {
            $repo->data_link = null;
            $repo->save();
        }
    }
};
