<?php

namespace App\Filament\Resources\AswatResource\Pages;

use App\Filament\Resources\AswatResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAswats extends ListRecords
{
    protected static string $resource = AswatResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
