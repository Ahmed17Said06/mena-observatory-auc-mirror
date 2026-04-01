<?php

namespace App\Filament\Resources\GenderAiResource\Pages;

use App\Filament\Resources\GenderAiResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGenderAi extends EditRecord
{
    protected static string $resource = GenderAiResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
