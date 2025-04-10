<?php

namespace App\Filament\Resources\AdditionalResourceResource\Pages;

use App\Filament\Resources\AdditionalResourceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdditional extends EditRecord
{
    protected static string $resource = AdditionalResourceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterSave(): void
    {
        $this->record->tags()->sync($this->data['tags']);
    }
    protected function beforeFill(): void
    {
        $this->record->tags = $this->record->tags->pluck('id')->toArray();
    }
}
