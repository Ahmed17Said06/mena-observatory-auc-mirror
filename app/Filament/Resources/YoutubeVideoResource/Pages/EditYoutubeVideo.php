<?php

namespace App\Filament\Resources\YoutubeVideoResource\Pages;

use App\Filament\Resources\YoutubeVideoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditYoutubeVideo extends EditRecord
{
    protected static string $resource = YoutubeVideoResource::class;

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
        $this->record->tags()->sync($this->data['tags'] ?? []);
    }

    protected function beforeFill(): void
    {
        $this->record->tags = $this->record->tags->pluck('id')->toArray();
    }
}
