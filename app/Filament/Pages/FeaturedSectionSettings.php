<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\SavesStaticContent;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class FeaturedSectionSettings extends Page implements HasForms
{
    use InteractsWithForms, SavesStaticContent;

    protected static ?string $navigationIcon  = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Featured Section';
    protected static ?string $navigationGroup = 'Page Content';
    protected static ?int    $navigationSort  = 0;
    protected static string  $view            = 'filament.pages.announcement-bar-settings';

    // Safe AI for Children
    public string $safe_ai_title_en    = '';
    public string $safe_ai_title_ar    = '';
    public string $safe_ai_desc_en     = '';
    public string $safe_ai_desc_ar     = '';

    // RAI Cup
    public string $rai_cup_title_en    = '';
    public string $rai_cup_title_ar    = '';
    public string $rai_cup_subtitle_en = '';
    public string $rai_cup_subtitle_ar = '';

    // GIRAI
    public string $girai_title_en      = '';
    public string $girai_title_ar      = '';
    public string $girai_desc_en       = '';
    public string $girai_desc_ar       = '';

    // Future of Work MENA
    public string $pw_mena_title_en    = '';
    public string $pw_mena_title_ar    = '';
    public string $pw_mena_desc_en     = '';
    public string $pw_mena_desc_ar     = '';

    // Brochures
    public string $brochures_title_en  = '';
    public string $brochures_title_ar  = '';
    public string $brochures_desc_en   = '';
    public string $brochures_desc_ar   = '';

    public function mount(): void
    {
        $this->safe_ai_title_en    = $this->getVal('featured_safe_ai_title');
        $this->safe_ai_title_ar    = $this->getArVal('featured_safe_ai_title');
        $this->safe_ai_desc_en     = $this->getVal('featured_safe_ai_desc');
        $this->safe_ai_desc_ar     = $this->getArVal('featured_safe_ai_desc');

        $this->rai_cup_title_en    = $this->getVal('featured_rai_cup_title');
        $this->rai_cup_title_ar    = $this->getArVal('featured_rai_cup_title');
        $this->rai_cup_subtitle_en = $this->getVal('featured_rai_cup_subtitle');
        $this->rai_cup_subtitle_ar = $this->getArVal('featured_rai_cup_subtitle');

        $this->girai_title_en      = $this->getVal('featured_girai_title');
        $this->girai_title_ar      = $this->getArVal('featured_girai_title');
        $this->girai_desc_en       = $this->getVal('featured_girai_desc');
        $this->girai_desc_ar       = $this->getArVal('featured_girai_desc');

        $this->pw_mena_title_en    = $this->getVal('featured_pw_mena_title');
        $this->pw_mena_title_ar    = $this->getArVal('featured_pw_mena_title');
        $this->pw_mena_desc_en     = $this->getVal('featured_pw_mena_desc');
        $this->pw_mena_desc_ar     = $this->getArVal('featured_pw_mena_desc');

        $this->brochures_title_en  = $this->getVal('featured_brochures_title');
        $this->brochures_title_ar  = $this->getArVal('featured_brochures_title');
        $this->brochures_desc_en   = $this->getVal('featured_brochures_desc');
        $this->brochures_desc_ar   = $this->getArVal('featured_brochures_desc');
    }

    protected function getFormSchema(): array
    {
        return [
            Fieldset::make('Safe AI for Children (MENA Chapter)')->schema([
                TextInput::make('safe_ai_title_en')->label('Title (EN)')->columnSpan(1),
                TextInput::make('safe_ai_title_ar')->label('Title (AR)')->columnSpan(1),
                TextInput::make('safe_ai_desc_en')->label('Description (EN)')->columnSpan(1),
                TextInput::make('safe_ai_desc_ar')->label('Description (AR)')->columnSpan(1),
            ])->columns(2)->columnSpanFull(),

            Fieldset::make('Responsible AI Cup (Awards Ceremony)')->schema([
                TextInput::make('rai_cup_title_en')->label('Title (EN)')->columnSpan(1),
                TextInput::make('rai_cup_title_ar')->label('Title (AR)')->columnSpan(1),
                TextInput::make('rai_cup_subtitle_en')->label('Subtitle (EN)')->columnSpan(1),
                TextInput::make('rai_cup_subtitle_ar')->label('Subtitle (AR)')->columnSpan(1),
            ])->columns(2)->columnSpanFull(),

            Fieldset::make('Global Index on Responsible AI (GIRAI)')->schema([
                TextInput::make('girai_title_en')->label('Title (EN)')->columnSpan(1),
                TextInput::make('girai_title_ar')->label('Title (AR)')->columnSpan(1),
                TextInput::make('girai_desc_en')->label('Description (EN)')->columnSpan(1),
                TextInput::make('girai_desc_ar')->label('Description (AR)')->columnSpan(1),
            ])->columns(2)->columnSpanFull(),

            Fieldset::make('Future of Work MENA (Platform Workers)')->schema([
                TextInput::make('pw_mena_title_en')->label('Title (EN)')->columnSpan(1),
                TextInput::make('pw_mena_title_ar')->label('Title (AR)')->columnSpan(1),
                TextInput::make('pw_mena_desc_en')->label('Description (EN)')->columnSpan(1),
                TextInput::make('pw_mena_desc_ar')->label('Description (AR)')->columnSpan(1),
            ])->columns(2)->columnSpanFull(),

            Fieldset::make('MENA Observatory Brochures')->schema([
                TextInput::make('brochures_title_en')->label('Title (EN)')->columnSpan(1),
                TextInput::make('brochures_title_ar')->label('Title (AR)')->columnSpan(1),
                TextInput::make('brochures_desc_en')->label('Description (EN)')->columnSpan(1),
                TextInput::make('brochures_desc_ar')->label('Description (AR)')->columnSpan(1),
            ])->columns(2)->columnSpanFull(),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->saveKeyBilingual('featured_safe_ai_title',    $data['safe_ai_title_en'],    $data['safe_ai_title_ar']);
        $this->saveKeyBilingual('featured_safe_ai_desc',     $data['safe_ai_desc_en'],     $data['safe_ai_desc_ar']);
        $this->saveKeyBilingual('featured_rai_cup_title',    $data['rai_cup_title_en'],    $data['rai_cup_title_ar']);
        $this->saveKeyBilingual('featured_rai_cup_subtitle', $data['rai_cup_subtitle_en'], $data['rai_cup_subtitle_ar']);
        $this->saveKeyBilingual('featured_girai_title',      $data['girai_title_en'],      $data['girai_title_ar']);
        $this->saveKeyBilingual('featured_girai_desc',       $data['girai_desc_en'],       $data['girai_desc_ar']);
        $this->saveKeyBilingual('featured_pw_mena_title',    $data['pw_mena_title_en'],    $data['pw_mena_title_ar']);
        $this->saveKeyBilingual('featured_pw_mena_desc',     $data['pw_mena_desc_en'],     $data['pw_mena_desc_ar']);
        $this->saveKeyBilingual('featured_brochures_title',  $data['brochures_title_en'],  $data['brochures_title_ar']);
        $this->saveKeyBilingual('featured_brochures_desc',   $data['brochures_desc_en'],   $data['brochures_desc_ar']);

        Notification::make()->title('Featured section updated')->success()->send();
    }
}
