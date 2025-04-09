<?php

namespace App\Filament\Resources\SubmittedWorkResource\Pages;

use App\Filament\Resources\SubmittedWorkResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubmittedWork extends EditRecord
{
    protected static string $resource = SubmittedWorkResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
