<?php

namespace App\Filament\Resources\RepoResource\Pages;

use App\Filament\Resources\RepoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRepo extends CreateRecord
{
    protected static string $resource = RepoResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $this->record->tags()->sync($this->data['tags']);
        $this->record->authors()->sync($this->data['authors']);
    }
}
