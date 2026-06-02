<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\SavesStaticContent;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class HomePageSettings extends Page implements HasForms
{
    use InteractsWithForms, SavesStaticContent;

    protected static ?string $navigationIcon  = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Home Page';
    protected static ?string $navigationGroup = 'Page Content';
    protected static ?int    $navigationSort  = 1;
    protected static string  $view            = 'filament.pages.announcement-bar-settings';

    public string $intro        = '';
    public string $story        = '';
    public string $vision       = '';
    public string $objective_1  = '';
    public string $objective_2  = '';
    public string $objective_3  = '';
    public string $objective_4  = '';
    public string $objective_5  = '';
    public string $ai_indices   = '';

    public function mount(): void
    {
        $this->intro       = $this->getVal('Intro');
        $this->story       = $this->getVal('Our Story');
        $this->vision      = $this->getVal('vision');
        $this->objective_1 = $this->getVal('Objective - 1');
        $this->objective_2 = $this->getVal('Objective - 2');
        $this->objective_3 = $this->getVal('Objective - 3');
        $this->objective_4 = $this->getVal('Objective - 4');
        $this->objective_5 = $this->getVal('Objective - 5');
        $this->ai_indices  = $this->getVal('AI Indices Intro');
    }

    protected function getFormSchema(): array
    {
        return [
            Textarea::make('intro')->label('Intro text')->rows(3)->columnSpanFull(),
            Textarea::make('story')->label('Our Story')->rows(4)->columnSpanFull(),
            Textarea::make('vision')->label('Vision')->rows(3)->columnSpanFull(),
            TextInput::make('objective_1')->label('Objective 1')->columnSpanFull(),
            TextInput::make('objective_2')->label('Objective 2')->columnSpanFull(),
            TextInput::make('objective_3')->label('Objective 3')->columnSpanFull(),
            TextInput::make('objective_4')->label('Objective 4')->columnSpanFull(),
            TextInput::make('objective_5')->label('Objective 5')->columnSpanFull(),
            Textarea::make('ai_indices')->label('AI Indices Intro')->rows(3)->columnSpanFull(),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $this->saveKey('Intro',          $data['intro']);
        $this->saveKey('Our Story',      $data['story']);
        $this->saveKey('vision',         $data['vision']);
        $this->saveKey('Objective - 1',  $data['objective_1']);
        $this->saveKey('Objective - 2',  $data['objective_2']);
        $this->saveKey('Objective - 3',  $data['objective_3']);
        $this->saveKey('Objective - 4',  $data['objective_4']);
        $this->saveKey('Objective - 5',  $data['objective_5']);
        $this->saveKey('AI Indices Intro', $data['ai_indices']);
        Notification::make()->title('Home page content updated')->success()->send();
    }
}
