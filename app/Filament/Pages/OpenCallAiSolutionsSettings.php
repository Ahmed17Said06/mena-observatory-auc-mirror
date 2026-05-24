<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\SavesStaticContent;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class OpenCallAiSolutionsSettings extends Page implements HasForms
{
    use InteractsWithForms, SavesStaticContent;

    protected static ?string $navigationIcon  = 'heroicon-o-light-bulb';
    protected static ?string $navigationLabel = 'Open Call: AI Solutions';
    protected static ?string $navigationGroup = 'Page Content';
    protected static ?int    $navigationSort  = 8;
    protected static string  $view            = 'filament.pages.announcement-bar-settings';

    public string $hero_title    = '';
    public string $hero_subtitle = '';
    public string $body          = '';

    public function mount(): void
    {
        $this->hero_title    = $this->getVal('ocais_hero_title');
        $this->hero_subtitle = $this->getVal('ocais_hero_subtitle');
        $this->body          = $this->getRichVal('ocais_body');
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
        $this->saveKey('ocais_hero_title',    $data['hero_title']);
        $this->saveKey('ocais_hero_subtitle', $data['hero_subtitle']);
        $this->saveKey('ocais_body',          $data['body']);
        Notification::make()->title('Open Call: AI Solutions page updated')->success()->send();
    }
}
