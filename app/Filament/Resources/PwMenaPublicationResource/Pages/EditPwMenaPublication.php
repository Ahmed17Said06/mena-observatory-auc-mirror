<?php

namespace App\Filament\Resources\PwMenaPublicationResource\Pages;

use App\Filament\Resources\PwMenaPublicationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPwMenaPublication extends EditRecord
{
    protected static string $resource = PwMenaPublicationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
