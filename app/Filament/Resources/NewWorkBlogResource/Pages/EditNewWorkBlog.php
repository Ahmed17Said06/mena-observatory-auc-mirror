<?php

namespace App\Filament\Resources\NewWorkBlogResource\Pages;

use App\Filament\Resources\NewWorkBlogResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewWorkBlog extends EditRecord
{
    protected static string $resource = NewWorkBlogResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterSave(): void
    {
        $this->record->tags()->sync($this->data['tags']);
    }
    
    protected function beforeFill(): void
    {
        $this->record->tags = $this->record->tags->pluck('id')->toArray();
    }
}