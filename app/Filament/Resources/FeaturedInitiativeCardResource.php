<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeaturedInitiativeCardResource\Pages;
use App\Models\FeaturedInitiativeCard;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;

class FeaturedInitiativeCardResource extends Resource
{
    protected static ?string $model = FeaturedInitiativeCard::class;

    protected static ?string $navigationIcon  = 'heroicon-o-photograph';
    protected static ?string $navigationLabel = 'Initiative Cards';
    protected static ?string $navigationGroup = 'Home Page';
    protected static ?int    $navigationSort  = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('label_en')->label('Card Label (EN)')->required()->columnSpan(1),
            TextInput::make('label_ar')->label('Card Label (AR)')->columnSpan(1),
            TextInput::make('sub_label_en')->label('Sub-label (EN)')->columnSpan(1),
            TextInput::make('sub_label_ar')->label('Sub-label (AR)')->columnSpan(1),
            FileUpload::make('image')
                ->label('Card Image')
                ->disk('public')
                ->directory('initiative-cards')
                ->image()
                ->enableOpen()
                ->columnSpanFull(),
            TextInput::make('title_en')->label('Title (EN)')->required()->columnSpan(1),
            TextInput::make('title_ar')->label('Title (AR)')->columnSpan(1),
            TextInput::make('link')->label('Link (URL or route name)')->required()->columnSpanFull()
                ->helperText('Use a full URL (https://...) for external links, or a route name (e.g. pw_mena) for internal pages.'),
            Toggle::make('link_external')->label('External link (opens in new tab)')->columnSpanFull(),
            TextInput::make('button_text_en')->label('Button Text (EN)')->required()->columnSpan(1),
            TextInput::make('button_text_ar')->label('Button Text (AR)')->columnSpan(1),
            Select::make('button_icon')
                ->label('Button Icon')
                ->options([
                    'fa-plus'             => 'Plus (+)',
                    'fa-external-link-alt' => 'External Link',
                    'fa-arrow-right'      => 'Arrow Right',
                    'fa-search'           => 'Search',
                ])
                ->default('fa-plus')
                ->columnSpan(1),
            TextInput::make('sort_order')->label('Sort Order')->numeric()->default(0)->columnSpan(1),
            Toggle::make('is_active')->label('Active')->default(true)->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('#')->sortable(),
                ImageColumn::make('image')->disk('public')->label('Image'),
                TextColumn::make('label_en')->label('Label')->searchable(),
                TextColumn::make('title_en')->label('Title')->limit(40),
                IconColumn::make('is_active')->label('Active')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->actions([EditAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListFeaturedInitiativeCards::route('/'),
            'create' => Pages\CreateFeaturedInitiativeCard::route('/create'),
            'edit'   => Pages\EditFeaturedInitiativeCard::route('/{record}/edit'),
        ];
    }
}
