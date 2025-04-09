<?php

namespace App\Filament\Resources\SubmittedWorkResource\Pages;

use App\Filament\Resources\SubmittedWorkResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubmittedWorks extends ListRecords
{
    protected static string $resource = SubmittedWorkResource::class;

    protected function getActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
