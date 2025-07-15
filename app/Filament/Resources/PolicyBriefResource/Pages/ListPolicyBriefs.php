<?php

namespace App\Filament\Resources\PolicyBriefResource\Pages;

use App\Filament\Resources\PolicyBriefResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPolicyBriefs extends ListRecords
{
    protected static string $resource = PolicyBriefResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
