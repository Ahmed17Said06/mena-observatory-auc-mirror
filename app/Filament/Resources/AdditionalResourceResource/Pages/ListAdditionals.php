<?php

namespace App\Filament\Resources\AdditionalResourceResource\Pages;

use App\Filament\Resources\AdditionalResourceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdditionals extends ListRecords
{
    protected static string $resource = AdditionalResourceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
