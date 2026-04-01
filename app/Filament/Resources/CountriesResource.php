<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountriesResource\Pages;
use App\Filament\Resources\CountriesResource\RelationManagers;
use App\Models\countries;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class CountriesResource extends Resource
{
    protected static ?string $model = countries::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $modelLabel='Knowledge Hub Region';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('ar_name')->required(),
                RichEditor::make('intro')->required()->label('left content'),
                RichEditor::make('ar_intro')->required()->label('arabic left content'),
                RichEditor::make('right_intro')->required()->label('right content'),
                RichEditor::make('ar_right_intro')->required()->label('arabic right content'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Country Name')->name('name'),
                TextColumn::make('AR Country Name')->label('arabic name')->name('ar_name'),
                TextColumn::make('intro')->limit(25)->label('left content'),
                TextColumn::make('ar_intro')->limit(25)->label('arabic left content'),
                TextColumn::make('right_intro')->limit(25)->label('right content'),
                TextColumn::make('ar_right_intro')->limit(25)->label('arabic right content'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountries::route('/create'),
            'edit' => Pages\EditCountries::route('/{record}/edit'),
        ];
    }
}
