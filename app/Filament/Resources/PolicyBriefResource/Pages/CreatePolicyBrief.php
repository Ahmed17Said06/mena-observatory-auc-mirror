<?php

namespace App\Filament\Resources\PolicyBriefResource\Pages;

use App\Filament\Resources\PolicyBriefResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePolicyBrief extends CreateRecord
{
    protected static string $resource = PolicyBriefResource::class;

    protected function afterCreate(): void
    {
        // Sync tags after creating the policy brief
        if (isset($this->data['tags']) && !empty($this->data['tags'])) {
            $this->record->tags()->sync($this->data['tags']);
        }

        // Sync communities after creating the policy brief
        if (isset($this->data['communities']) && !empty($this->data['communities'])) {
            $this->record->communities()->sync($this->data['communities']);
        }

        // Sync authors after creating the policy brief
        if (isset($this->data['authors']) && !empty($this->data['authors'])) {
            $this->record->authors()->sync($this->data['authors']);
        }
    }
}
