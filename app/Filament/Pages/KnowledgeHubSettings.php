<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\SavesStaticContent;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class KnowledgeHubSettings extends Page implements HasForms
{
    use InteractsWithForms, SavesStaticContent;

    protected static ?string $navigationIcon  = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Knowledge Hub';
    protected static ?string $navigationGroup = 'Page Content';
    protected static ?int    $navigationSort  = 4;
    protected static string  $view            = 'filament.pages.announcement-bar-settings';

    public string $intro        = '';
    public string $our_work     = '';
    public string $regional     = '';
    public string $global       = '';

    public function mount(): void
    {
        $this->intro    = $this->getVal('regional intro');
        $this->our_work = $this->getVal('kh_our_work_desc');
        $this->regional = $this->getVal('kh_regional_work_desc');
        $this->global   = $this->getVal('kh_global_work_desc');
    }

    protected function getFormSchema(): array
    {
        return [
            Textarea::make('intro')->label('Knowledge Hub Intro')->rows(3)->columnSpanFull(),
            Textarea::make('our_work')->label('Observatory Outputs description')->rows(2)->columnSpanFull(),
            Textarea::make('regional')->label('Regional Resources description')->rows(2)->columnSpanFull(),
            Textarea::make('global')->label('Global Resources description')->rows(2)->columnSpanFull(),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $this->saveKey('regional intro',       $data['intro']);
        $this->saveKey('kh_our_work_desc',     $data['our_work']);
        $this->saveKey('kh_regional_work_desc', $data['regional']);
        $this->saveKey('kh_global_work_desc',  $data['global']);
        Notification::make()->title('Knowledge Hub content updated')->success()->send();
    }
}
