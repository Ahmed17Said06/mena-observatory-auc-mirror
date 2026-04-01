<?php

namespace App\Filament\Resources\FeaturedPostResource\Pages;

use App\Filament\Resources\FeaturedPostResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFeaturedPost extends CreateRecord
{
    protected static string $resource = FeaturedPostResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
