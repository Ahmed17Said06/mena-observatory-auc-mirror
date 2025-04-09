<?php

namespace App\Filament\Resources\RepoTypeResource\Pages;

use App\Filament\Resources\RepoTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRepoTypes extends ListRecords
{
    protected static string $resource = RepoTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
