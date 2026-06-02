<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\SavesStaticContent;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class NewWorkSettings extends Page implements HasForms
{
    use InteractsWithForms, SavesStaticContent;

    protected static ?string $navigationIcon  = 'heroicon-o-pencil';
    protected static ?string $navigationLabel = 'New Work Page';
    protected static ?string $navigationGroup = 'Page Content';
    protected static ?int    $navigationSort  = 5;
    protected static string  $view            = 'filament.pages.announcement-bar-settings';

    public string $description = '';

    public function mount(): void
    {
        $this->description = $this->getVal('new_work_description');
    }

    protected function getFormSchema(): array
    {
        return [
            Textarea::make('description')->label('New Work page description')->rows(4)->columnSpanFull(),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $this->saveKey('new_work_description', $data['description']);
        Notification::make()->title('New Work content updated')->success()->send();
    }
}
