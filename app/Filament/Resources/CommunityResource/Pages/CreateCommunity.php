<?php

namespace App\Filament\Resources\CommunityResource\Pages;

use App\Filament\Resources\CommunityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCommunity extends CreateRecord
{
    protected static string $resource = CommunityResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
//        $this->record->tags()->sync($this->data['tags']);
    }
}
