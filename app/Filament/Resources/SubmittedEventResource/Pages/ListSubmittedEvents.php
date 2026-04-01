<?php

namespace App\Filament\Resources\SubmittedEventResource\Pages;

use App\Filament\Resources\SubmittedEventResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubmittedEvents extends ListRecords
{
    protected static string $resource = SubmittedEventResource::class;

    protected function getActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
