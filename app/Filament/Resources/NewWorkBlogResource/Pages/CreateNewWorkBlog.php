<?php

namespace App\Filament\Resources\NewWorkBlogResource\Pages;

use App\Filament\Resources\NewWorkBlogResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNewWorkBlog extends CreateRecord
{
    protected static string $resource = NewWorkBlogResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $this->record->tags()->sync($this->data['tags']);
    }
}