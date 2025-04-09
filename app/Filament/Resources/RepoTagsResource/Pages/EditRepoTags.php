<?php

namespace App\Filament\Resources\RepoTagsResource\Pages;

use App\Filament\Resources\RepoTagsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRepoTags extends EditRecord
{
    protected static string $resource = RepoTagsResource::class;

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
}
