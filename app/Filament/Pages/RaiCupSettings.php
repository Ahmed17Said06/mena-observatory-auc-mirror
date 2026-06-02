<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\SavesStaticContent;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class RaiCupSettings extends Page implements HasForms
{
    use InteractsWithForms, SavesStaticContent;

    protected static ?string $navigationIcon  = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'RAI Cup Page';
    protected static ?string $navigationGroup = 'Page Content';
    protected static ?int    $navigationSort  = 7;
    protected static string  $view            = 'filament.pages.announcement-bar-settings';

    public string $hero_title    = '';
    public string $hero_subtitle = '';
    public string $event_date    = '';
    public string $event_location = '';
    public string $body          = '';

    public function mount(): void
    {
        $this->hero_title     = $this->getVal('rai_cup_hero_title');
        $this->hero_subtitle  = $this->getVal('rai_cup_hero_subtitle');
        $this->event_date     = $this->getVal('rai_cup_event_date');
        $this->event_location = $this->getVal('rai_cup_event_location');
        $this->body           = $this->getRichVal('rai_cup_body');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('hero_title')->label('Hero Title')->columnSpanFull(),
            TextInput::make('hero_subtitle')->label('Hero Subtitle')->columnSpanFull(),
            TextInput::make('event_date')->label('Event Date')->columnSpanFull(),
            TextInput::make('event_location')->label('Event Location')->columnSpanFull(),
            RichEditor::make('body')->label('Page Body')->columnSpanFull(),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $this->saveKey('rai_cup_hero_title',    $data['hero_title']);
        $this->saveKey('rai_cup_hero_subtitle', $data['hero_subtitle']);
        $this->saveKey('rai_cup_event_date',    $data['event_date']);
        $this->saveKey('rai_cup_event_location', $data['event_location']);
        $this->saveKey('rai_cup_body',           $data['body']);
        Notification::make()->title('RAI Cup page updated')->success()->send();
    }
}
