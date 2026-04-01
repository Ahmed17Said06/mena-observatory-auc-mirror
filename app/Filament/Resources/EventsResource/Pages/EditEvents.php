<?php

namespace App\Filament\Resources\EventsResource\Pages;

use App\Filament\Resources\EventsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvents extends EditRecord
{
    protected static string $resource = EventsResource::class;

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
//        $this->record->communities()->sync($this->data['communities']);
    }
    protected function beforeFill(): void
    {
        $this->record->tags = $this->record->tags->pluck('id')->toArray();
    }
}
