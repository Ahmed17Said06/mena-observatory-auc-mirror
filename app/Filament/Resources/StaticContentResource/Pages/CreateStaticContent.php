<?php

namespace App\Filament\Resources\StaticContentResource\Pages;

use App\Filament\Resources\StaticContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStaticContent extends CreateRecord
{
    protected static string $resource = StaticContentResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
