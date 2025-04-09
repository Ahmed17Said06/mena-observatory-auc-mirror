<?php

namespace App\Filament\Resources\AdditionalResource\Pages;

use App\Filament\Resources\AdditionalResourceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdditional extends CreateRecord
{
    protected static string $resource = AdditionalResourceResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
//        $this->record->tags()->sync($this->data['tags']);
    }
}
