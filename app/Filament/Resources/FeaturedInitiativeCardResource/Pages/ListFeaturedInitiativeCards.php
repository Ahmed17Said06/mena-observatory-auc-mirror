<?php

namespace App\Filament\Resources\FeaturedInitiativeCardResource\Pages;

use App\Filament\Resources\FeaturedInitiativeCardResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFeaturedInitiativeCards extends ListRecords
{
    protected static string $resource = FeaturedInitiativeCardResource::class;

    protected function getActions(): array
    {
        return [CreateAction::make()];
    }
}
