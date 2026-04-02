<?php

namespace App\Filament\Resources\BrochureResource\Pages;

use App\Filament\Resources\BrochureResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBrochure extends CreateRecord
{
    protected static string $resource = BrochureResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
