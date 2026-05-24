<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\SavesStaticContent;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class OpenCallRaiUseCasesSettings extends Page implements HasForms
{
    use InteractsWithForms, SavesStaticContent;

    protected static ?string $navigationIcon  = 'heroicon-o-clipboard-list';
    protected static ?string $navigationLabel = 'Open Call: RAI Use Cases';
    protected static ?string $navigationGroup = 'Page Content';
    protected static ?int    $navigationSort  = 9;
    protected static string  $view            = 'filament.pages.announcement-bar-settings';

    public string $hero_title    = '';
    public string $hero_subtitle = '';
    public string $body          = '';

    public function mount(): void
    {
        $this->hero_title    = $this->getVal('ocruc_hero_title');
        $this->hero_subtitle = $this->getVal('ocruc_hero_subtitle');
        $this->body          = $this->getRichVal('ocruc_body');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('hero_title')->label('Hero Title')->columnSpanFull(),
            TextInput::make('hero_subtitle')->label('Hero Subtitle')->columnSpanFull(),
            RichEditor::make('body')->label('Page Body')->columnSpanFull(),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $this->saveKey('ocruc_hero_title',    $data['hero_title']);
        $this->saveKey('ocruc_hero_subtitle', $data['hero_subtitle']);
        $this->saveKey('ocruc_body',          $data['body']);
        Notification::make()->title('Open Call: RAI Use Cases page updated')->success()->send();
    }
}
