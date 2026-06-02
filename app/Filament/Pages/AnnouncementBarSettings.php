<?php

namespace App\Filament\Pages;

use App\Models\static_content;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AnnouncementBarSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon  = 'heroicon-o-speakerphone';
    protected static ?string $navigationLabel = 'Announcement Bar';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int    $navigationSort  = 1;
    protected static string  $view            = 'filament.pages.announcement-bar-settings';

    public string $text    = '';
    public string $link    = '';
    public bool   $enabled = false;

    public function mount(): void
    {
        $this->text    = strip_tags(static_content::where('key', 'announcement_text')->latest()->value('content') ?? '');
        $this->link    = strip_tags(static_content::where('key', 'announcement_link')->latest()->value('content') ?? '');
        $raw           = static_content::where('key', 'announcement_enabled')->latest()->value('content') ?? 'no';
        $this->enabled = in_array(strtolower(trim(strip_tags($raw))), ['yes', 'true', '1', 'on']);
    }

    protected function getFormSchema(): array
    {
        return [
            Toggle::make('enabled')
                ->label('Show announcement bar')
                ->helperText('Toggle to show or hide the blue strip at the top of every page.')
                ->onColor('success'),

            TextInput::make('text')
                ->label('Announcement text')
                ->placeholder('e.g. New report published — read it now.')
                ->maxLength(300)
                ->columnSpanFull(),

            TextInput::make('link')
                ->label('Learn more URL')
                ->placeholder('https://...')
                ->url()
                ->columnSpanFull(),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->saveKey('announcement_enabled', $data['enabled'] ? 'yes' : 'no');
        $this->saveKey('announcement_text',    $data['text']);
        $this->saveKey('announcement_link',    $data['link']);

        Notification::make()
            ->title('Announcement bar updated')
            ->success()
            ->send();
    }

    private function saveKey(string $key, string $value): void
    {
        static_content::where('key', $key)->delete();
        static_content::create([
            'key'       => $key,
            'content'   => $value,
            'page'      => 'global',
            'has_media' => 'no',
        ]);
    }
}
