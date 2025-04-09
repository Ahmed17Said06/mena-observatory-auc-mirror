<?php

namespace App\Filament\Resources\SubmittedEventResource\Pages;

use App\Filament\Resources\SubmittedEventResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubmittedEvent extends EditRecord
{
    protected static string $resource = SubmittedEventResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
