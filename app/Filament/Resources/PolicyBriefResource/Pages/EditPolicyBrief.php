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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load existing tags, communities, and authors for editing
        $data['tags'] = $this->record->tags->pluck('id')->toArray();
        $data['communities'] = $this->record->communities->pluck('id')->toArray();
        $data['authors'] = $this->record->authors->pluck('id')->toArray();
        
        return $data;
    }

    protected function afterSave(): void
    {
        // Sync tags after saving the policy brief
        if (isset($this->data['tags'])) {
            $this->record->tags()->sync($this->data['tags']);
        } else {
            $this->record->tags()->sync([]);
        }

        // Sync communities after saving the policy brief
        if (isset($this->data['communities'])) {
            $this->record->communities()->sync($this->data['communities']);
        } else {
            $this->record->communities()->sync([]);
        }

        // Sync authors after saving the policy brief
        if (isset($this->data['authors'])) {
            $this->record->authors()->sync($this->data['authors']);
        } else {
            $this->record->authors()->sync([]);
        }
    }
}
