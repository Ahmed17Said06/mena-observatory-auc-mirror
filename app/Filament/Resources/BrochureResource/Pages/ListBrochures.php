<?php

namespace App\Filament\Resources\BrochureResource\Pages;

use App\Filament\Resources\BrochureResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBrochures extends ListRecords
{
    protected static string $resource = BrochureResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
