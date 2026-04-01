<?php

namespace App\Filament\Resources\StaticContentResource\Pages;

use App\Filament\Resources\StaticContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStaticContent extends EditRecord
{
    protected static string $resource = StaticContentResource::class;

    protected function getActions(): array
    {
        return [
//            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
