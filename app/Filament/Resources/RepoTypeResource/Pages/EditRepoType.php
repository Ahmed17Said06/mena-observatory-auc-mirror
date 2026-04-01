<?php

namespace App\Filament\Resources\RepoTypeResource\Pages;

use App\Filament\Resources\RepoTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRepoType extends EditRecord
{
    protected static string $resource = RepoTypeResource::class;

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
