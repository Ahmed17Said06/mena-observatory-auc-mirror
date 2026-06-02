<?php

namespace App\Filament\Resources\FeaturedInitiativeCardResource\Pages;

use App\Filament\Resources\FeaturedInitiativeCardResource;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFeaturedInitiativeCard extends EditRecord
{
    protected static string $resource = FeaturedInitiativeCardResource::class;

    protected function getActions(): array
    {
        return [DeleteAction::make()];
    }
}
