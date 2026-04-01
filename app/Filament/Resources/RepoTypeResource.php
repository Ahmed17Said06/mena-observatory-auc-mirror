<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RepoTypeResource\Pages;
use App\Filament\Resources\RepoTypeResource\RelationManagers;
use App\Models\Repo_type;
use App\Models\RepoType;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RepoTypeResource extends Resource
{
    protected static ?string $model = Repo_type::class;
    protected static ?string $modelLabel = 'Knowledge Hub Types';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),

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
            'index' => Pages\ListRepoTypes::route('/'),
            'create' => Pages\CreateRepoType::route('/create'),
            'edit' => Pages\EditRepoType::route('/{record}/edit'),
        ];
    }
}
