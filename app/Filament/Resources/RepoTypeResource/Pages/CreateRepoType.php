<?php

namespace App\Filament\Resources\RepoTypeResource\Pages;

use App\Filament\Resources\RepoTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRepoType extends CreateRecord
{
    protected static string $resource = RepoTypeResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
