<?php

namespace App\Filament\Resources\FeaturedPostResource\Pages;

use App\Filament\Resources\FeaturedPostResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeaturedPost extends EditRecord
{
    protected static string $resource = FeaturedPostResource::class;

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
