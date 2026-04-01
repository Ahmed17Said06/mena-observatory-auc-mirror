<?php

namespace App\Filament\Resources\FeaturedPostResource\Pages;

use App\Filament\Resources\FeaturedPostResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeaturedPosts extends ListRecords
{
    protected static string $resource = FeaturedPostResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
