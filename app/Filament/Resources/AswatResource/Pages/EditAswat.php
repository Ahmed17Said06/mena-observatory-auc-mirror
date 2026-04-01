<?php

namespace App\Filament\Resources\AswatResource\Pages;

use App\Filament\Resources\AswatResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAswat extends EditRecord
{
    protected static string $resource = AswatResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
