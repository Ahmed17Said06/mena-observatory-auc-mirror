<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RepoTagsResource\Pages;
use App\Filament\Resources\RepoTagsResource\RelationManagers;
use App\Models\Repo_tags;
use App\Models\RepoTags;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RepoTagsResource extends Resource
{
    protected static ?string $model = Repo_tags::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $label = 'tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->unique(ignoreRecord: true)->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListRepoTags::route('/'),
            'create' => Pages\CreateRepoTags::route('/create'),
            'edit' => Pages\EditRepoTags::route('/{record}/edit'),
        ];
    }
}
