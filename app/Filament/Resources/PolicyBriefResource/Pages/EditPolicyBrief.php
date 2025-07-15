<?php

namespace App\Filament\Resources\PolicyBriefResource\Pages;

use App\Filament\Resources\PolicyBriefResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPolicyBrief extends EditRecord
{
    protected static string $resource = PolicyBriefResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
