<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkTogetherResource\Pages;
use App\Filament\Resources\WorkTogetherResource\RelationManagers;
use App\Models\Article;
use App\Models\WorkTogether;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkTogetherResource extends Resource
{
    protected static ?string $model = WorkTogether::class;

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
                        fn(WorkTogether $record): string => url($record->full_url_cv),
                        shouldOpenInNewTab: true
                    ),
                Tables\Actions\Action::make('download-two')
                    ->label('Collaborations')
                    ->icon('heroicon-o-download')
                    ->url(
                        fn(WorkTogether $record): string => url($record->full_url_collaboration),
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
            'index' => Pages\ListWorkTogethers::route('/'),
//            'create' => Pages\CreateWorkTogether::route('/create'),
            'edit' => Pages\EditWorkTogether::route('/{record}/edit'),
        ];
    }
}
