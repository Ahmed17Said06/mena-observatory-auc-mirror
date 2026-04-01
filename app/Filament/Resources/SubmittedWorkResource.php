<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmittedWorkResource\Pages;
use App\Filament\Resources\SubmittedWorkResource\RelationManagers;
use App\Models\SubmittedWork;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class SubmittedWorkResource extends Resource
{
    protected static ?string $model = SubmittedWork::class;

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
            ])
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('CV')
                    ->icon('heroicon-o-download')
                    ->url(
                        fn(SubmittedWork $record): string => url($record->full_url_cv),
                        shouldOpenInNewTab: true
                    ),
                Tables\Actions\Action::make('download-two')
                    ->label('Projects')
                    ->icon('heroicon-o-download')
                    ->url(
                        fn(SubmittedWork $record): string => url($record->full_url_project),
                        shouldOpenInNewTab: true
                    ),
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
            'index' => Pages\ListSubmittedWorks::route('/'),
//            'create' => Pages\CreateSubmittedWork::route('/create'),
            'edit' => Pages\EditSubmittedWork::route('/{record}/edit'),
        ];
    }
}
