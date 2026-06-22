<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\SavesStaticContent;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

/**
 * Manages the three featured cards at the top of the News page. Each card's
 * title/description (and link/button for card 3) and image are stored as
 * static_content rows (news_card_*); the image lives in the row's `media`.
 */
class NewsCardsSettings extends Page implements HasForms
{
    use InteractsWithForms, SavesStaticContent;

    protected static ?string $navigationIcon  = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'News: Featured Cards';
    protected static ?string $navigationGroup = 'Page Content';
    protected static ?int    $navigationSort  = 9;
    protected static string  $view            = 'filament.pages.announcement-bar-settings';

    public string  $card1_title = '';
    public string  $card1_desc  = '';
    public ?string $card1_image = null;

    public string  $card2_title = '';
    public string  $card2_desc  = '';
    public ?string $card2_image = null;

    public string  $card3_title = '';
    public string  $card3_desc  = '';
    public string  $card3_link  = '';
    public string  $card3_btn   = '';
    public ?string $card3_image = null;

    public function mount(): void
    {
        $this->card1_title = $this->getVal('news_card_1_title', 'Final Call for Submissions Open Call for Applied Inclusive AI Solutions – MENA Region');
        $this->card1_desc  = $this->getVal('news_card_1_desc', 'This is the final reminder to submit proposals to the Open Call launched by the MENA Observatory on Responsible AI at A2K4D.');
        $this->card1_image = $this->getMediaVal('news_card_1_title');

        $this->card2_title = $this->getVal('news_card_2_title', 'Open Call for Responsible AI Use Cases - MENA Region');
        $this->card2_desc  = $this->getVal('news_card_2_desc', 'The MENA Observatory on Responsible AI is seeking proposals for practical, responsible AI solutions.');
        $this->card2_image = $this->getMediaVal('news_card_2_title');

        $this->card3_title = $this->getVal('news_card_3_title', 'Nagla Rizk Contributes to Le Monde article on Education and AI Equity');
        $this->card3_desc  = $this->getVal('news_card_3_desc', 'AI could be a powerful lever to reduce inequalities between different socio-cultural backgrounds.');
        $this->card3_link  = $this->getVal('news_card_3_link', 'https://www.lemonde.fr/idees/article/2025/10/29/l-ia-pourrait-representer-un-puissant-levier-pour-reduire-les-inegalites-entre-differents-milieux-socioculturels_6650132_3232.html');
        $this->card3_btn   = $this->getVal('news_card_3_btn', 'Read Article');
        $this->card3_image = $this->getMediaVal('news_card_3_title');
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Card 1 — Open Call: AI Solutions')->schema([
                TextInput::make('card1_title')->label('Title')->columnSpanFull(),
                Textarea::make('card1_desc')->label('Description')->rows(2)->columnSpanFull(),
                FileUpload::make('card1_image')->label('Image')->image()
                    ->disk('public')->directory('news_cards')->columnSpanFull(),
            ]),
            Section::make('Card 2 — Open Call: RAI Use Cases')->schema([
                TextInput::make('card2_title')->label('Title')->columnSpanFull(),
                Textarea::make('card2_desc')->label('Description')->rows(2)->columnSpanFull(),
                FileUpload::make('card2_image')->label('Image')->image()
                    ->disk('public')->directory('news_cards')->columnSpanFull(),
            ]),
            Section::make('Card 3 — Article / Link')->schema([
                TextInput::make('card3_title')->label('Title')->columnSpanFull(),
                Textarea::make('card3_desc')->label('Description')->rows(2)->columnSpanFull(),
                TextInput::make('card3_link')->label('Link (URL)')->columnSpanFull(),
                TextInput::make('card3_btn')->label('Button Text')->columnSpanFull(),
                FileUpload::make('card3_image')->label('Image')->image()
                    ->disk('public')->directory('news_cards')->columnSpanFull(),
            ]),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->saveKeyWithMedia('news_card_1_title', $data['card1_title'], $data['card1_image'] ?? null);
        $this->saveKey('news_card_1_desc', $data['card1_desc']);

        $this->saveKeyWithMedia('news_card_2_title', $data['card2_title'], $data['card2_image'] ?? null);
        $this->saveKey('news_card_2_desc', $data['card2_desc']);

        $this->saveKeyWithMedia('news_card_3_title', $data['card3_title'], $data['card3_image'] ?? null);
        $this->saveKey('news_card_3_desc', $data['card3_desc']);
        $this->saveKey('news_card_3_link', $data['card3_link']);
        $this->saveKey('news_card_3_btn', $data['card3_btn']);

        Notification::make()->title('News featured cards updated')->success()->send();
    }
}
