<?php

namespace App\Filament\Resources\WorkTogetherResource\Pages;

use App\Filament\Resources\WorkTogetherResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkTogethers extends ListRecords
{
    protected static string $resource = WorkTogetherResource::class;

    protected function getActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
