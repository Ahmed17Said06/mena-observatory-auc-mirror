<?php

namespace App\Filament\Resources\NewWorkBlogResource\Pages;

use App\Filament\Resources\NewWorkBlogResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewWorkBlog extends ListRecords
{
    protected static string $resource = NewWorkBlogResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
