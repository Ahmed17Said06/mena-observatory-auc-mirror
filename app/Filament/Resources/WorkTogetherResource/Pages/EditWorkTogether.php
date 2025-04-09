<?php

namespace App\Filament\Resources\WorkTogetherResource\Pages;

use App\Filament\Resources\WorkTogetherResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkTogether extends EditRecord
{
    protected static string $resource = WorkTogetherResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
