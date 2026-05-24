<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\SavesStaticContent;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class CommunitySettings extends Page implements HasForms
{
    use InteractsWithForms, SavesStaticContent;

    protected static ?string $navigationIcon  = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Community Page';
    protected static ?string $navigationGroup = 'Page Content';
    protected static ?int    $navigationSort  = 6;
    protected static string  $view            = 'filament.pages.announcement-bar-settings';

    public string $intro = '';

    public function mount(): void
    {
        $this->intro = $this->getVal('community');
    }

    protected function getFormSchema(): array
    {
        return [
            Textarea::make('intro')->label('Community page intro text')->rows(4)->columnSpanFull(),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $this->saveKey('community', $data['intro']);
        Notification::make()->title('Community page content updated')->success()->send();
    }
}
