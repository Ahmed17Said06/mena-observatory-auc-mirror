<?php

namespace App\Filament\Resources\CommunityResource\Pages;

use App\Filament\Resources\CommunityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommunity extends EditRecord
{
    protected static string $resource = CommunityResource::class;

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
//        $this->record->tags()->sync($this->data['tags']);
        $this->record->interests()->sync($this->data['interests']);
    }
    protected function beforeFill(): void
    {
//          $this->record->tags = $this->record->tags->pluck('id')->toArray();
    }
}
