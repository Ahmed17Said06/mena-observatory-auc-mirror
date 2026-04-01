<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmittedEventResource\Pages;
use App\Filament\Resources\SubmittedEventResource\RelationManagers;
use App\Models\SubmittedEvent;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class SubmittedEventResource extends Resource
{
    protected static ?string $model = SubmittedEvent::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('phone')->searchable(),
                TextColumn::make('bio'),

                TextColumn::make('event_link')->limit('15')->url(
                    fn(SubmittedEvent $record): string => $record->event_link, shouldOpenInNewTab: true),
                TextColumn::make('event_description'),
                TextColumn::make('event_day')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Supported Material')
                    ->icon('heroicon-o-download')
                    ->hidden(fn(SubmittedEvent $record): bool => !$record->full_supported_material)
                    ->url(fn(SubmittedEvent $record): string => url($record->full_supported_material), shouldOpenInNewTab: true),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListSubmittedEvents::route('/'),
//            'create' => Pages\CreateSubmittedEvent::route('/create'),
            'edit' => Pages\EditSubmittedEvent::route('/{record}/edit'),
        ];
    }
}
