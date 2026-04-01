<?php

namespace App\Filament\Resources\RepoTagsResource\Pages;

use App\Filament\Resources\RepoTagsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRepoTags extends CreateRecord
{
    protected static string $resource = RepoTagsResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
