<?php

namespace App\Filament\Resources\RepoResource\Pages;

use App\Filament\Resources\RepoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRepos extends ListRecords
{
    protected static string $resource = RepoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
