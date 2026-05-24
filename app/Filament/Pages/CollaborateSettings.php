<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\SavesStaticContent;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class CollaborateSettings extends Page implements HasForms
{
    use InteractsWithForms, SavesStaticContent;

    protected static ?string $navigationIcon  = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Collaborate Page';
    protected static ?string $navigationGroup = 'Page Content';
    protected static ?int    $navigationSort  = 3;
    protected static string  $view            = 'filament.pages.announcement-bar-settings';

    public string $contact_intro        = '';
    public string $find_partners        = '';
    public string $share_relevant       = '';
    public string $share_work           = '';
    public string $want_to_work         = '';
    public string $want_share_event     = '';
    public string $want_share_work      = '';
    public string $footer_collaboration = '';
    public string $header_collaboration = '';

    public function mount(): void
    {
        $this->contact_intro        = $this->getVal('Contact Us Intro');
        $this->find_partners        = $this->getVal('find-partners');
        $this->share_relevant       = $this->getVal('share-relevant');
        $this->share_work           = $this->getVal('share-work');
        $this->want_to_work         = $this->getVal('want_to_work');
        $this->want_share_event     = $this->getVal('want_share_event');
        $this->want_share_work      = $this->getVal('want_share_work');
        $this->footer_collaboration = $this->getVal('footer_collaboration');
        $this->header_collaboration = $this->getVal('header_collaboration');
    }

    protected function getFormSchema(): array
    {
        return [
            Textarea::make('contact_intro')->label('Contact Us Intro')->rows(3)->columnSpanFull(),
            Textarea::make('find_partners')->label('Find Partners text')->rows(2)->columnSpanFull(),
            Textarea::make('share_relevant')->label('Share Relevant text')->rows(2)->columnSpanFull(),
            Textarea::make('share_work')->label('Share Work text')->rows(2)->columnSpanFull(),
            Textarea::make('want_to_work')->label('Want to Work Together text')->rows(2)->columnSpanFull(),
            Textarea::make('want_share_event')->label('Want to Share an Event text')->rows(2)->columnSpanFull(),
            Textarea::make('want_share_work')->label('Want to Share Work text')->rows(2)->columnSpanFull(),
            Textarea::make('footer_collaboration')->label('Footer Collaboration text')->rows(2)->columnSpanFull(),
            Textarea::make('header_collaboration')->label('Header Collaboration text')->rows(2)->columnSpanFull(),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $this->saveKey('Contact Us Intro',    $data['contact_intro']);
        $this->saveKey('find-partners',        $data['find_partners']);
        $this->saveKey('share-relevant',       $data['share_relevant']);
        $this->saveKey('share-work',           $data['share_work']);
        $this->saveKey('want_to_work',         $data['want_to_work']);
        $this->saveKey('want_share_event',     $data['want_share_event']);
        $this->saveKey('want_share_work',      $data['want_share_work']);
        $this->saveKey('footer_collaboration', $data['footer_collaboration']);
        $this->saveKey('header_collaboration', $data['header_collaboration']);
        Notification::make()->title('Collaborate page content updated')->success()->send();
    }
}
