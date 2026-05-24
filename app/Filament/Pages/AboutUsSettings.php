<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\SavesStaticContent;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AboutUsSettings extends Page implements HasForms
{
    use InteractsWithForms, SavesStaticContent;

    protected static ?string $navigationIcon  = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = 'About Us';
    protected static ?string $navigationGroup = 'Page Content';
    protected static ?int    $navigationSort  = 2;
    protected static string  $view            = 'filament.pages.announcement-bar-settings';

    public string $intro         = '';
    public string $video_content = '';

    public function mount(): void
    {
        $this->intro         = $this->getVal('About Us Intro');
        $this->video_content = $this->getVal('about_video_content');
    }

    protected function getFormSchema(): array
    {
        return [
            Textarea::make('intro')->label('About Us Intro')->rows(4)->columnSpanFull(),
            TextInput::make('video_content')->label('Video URL / Embed Code')->columnSpanFull(),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $this->saveKey('About Us Intro',      $data['intro']);
        $this->saveKey('about_video_content', $data['video_content']);
        Notification::make()->title('About Us content updated')->success()->send();
    }
}
