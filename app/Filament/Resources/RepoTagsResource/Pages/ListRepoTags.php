<?php

namespace App\Filament\Resources\RepoTagsResource\Pages;

use App\Filament\Resources\RepoTagsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRepoTags extends ListRecords
{
    protected static string $resource = RepoTagsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
