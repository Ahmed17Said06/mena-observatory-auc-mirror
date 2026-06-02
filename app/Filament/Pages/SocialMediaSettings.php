<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\SavesStaticContent;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SocialMediaSettings extends Page implements HasForms
{
    use InteractsWithForms, SavesStaticContent;

    protected static ?string $navigationIcon  = 'heroicon-o-share';
    protected static ?string $navigationLabel = 'Social Media Links';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int    $navigationSort  = 2;
    protected static string  $view            = 'filament.pages.announcement-bar-settings';

    public string $twitter   = '';
    public string $instagram = '';
    public string $facebook  = '';
    public string $youtube   = '';

    public function mount(): void
    {
        $this->twitter   = $this->getVal('social_twitter',   'https://x.com/MENAObs_AI');
        $this->instagram = $this->getVal('social_instagram', 'https://www.instagram.com/menaobservatory.ai/');
        $this->facebook  = $this->getVal('social_facebook',  'https://www.facebook.com/a2k4d/');
        $this->youtube   = $this->getVal('social_youtube',   'https://www.youtube.com/@MENAObservatory.AI_');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('twitter')->label('Twitter / X URL')->url()->columnSpanFull(),
            TextInput::make('instagram')->label('Instagram URL')->url()->columnSpanFull(),
            TextInput::make('facebook')->label('Facebook URL')->url()->columnSpanFull(),
            TextInput::make('youtube')->label('YouTube URL')->url()->columnSpanFull(),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $this->saveKey('social_twitter',   $data['twitter']);
        $this->saveKey('social_instagram', $data['instagram']);
        $this->saveKey('social_facebook',  $data['facebook']);
        $this->saveKey('social_youtube',   $data['youtube']);
        Notification::make()->title('Social media links updated')->success()->send();
    }
}
