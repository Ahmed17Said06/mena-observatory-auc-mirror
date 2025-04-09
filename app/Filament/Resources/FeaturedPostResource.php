<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeaturedPostResource\Pages;
use App\Filament\Resources\FeaturedPostResource\RelationManagers;
use App\Models\FeaturedPost;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\TemporaryUploadedFile;

class FeaturedPostResource extends Resource
{
    protected static ?string $model = FeaturedPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                TextInput::make('description')
                    ->hint(fn($state, $component) => 'left: ' . $component->getMaxLength() - strlen($state) . ' characters')
                    ->maxlength(160)
                    ->reactive(),
                FileUpload::make('image')->disk('public')->enableOpen()->image()->
                directory('storage')
                    ->label('Image')->getUploadedFileNameForStorageUsing(
                        function (TemporaryUploadedFile $file): string {
                            $imgName = strtolower(md5($file->
                                    getClientOriginalName() . time() . rand(1, 100))
                                . '.' . $file->getClientOriginalExtension());
                            return $file->storeAs('', $imgName, 'public');
                        }),
                Select::make('tag')
                    ->options([
                        'Research' => 'Research',
                        'Webinar' => 'Webinar',
                        'Podcast' => "Podcast",
                        'Post' => 'Post'
                    ])->required(),
                TextInput::make('url')->url(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('description')->limit(25),
                TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListFeaturedPosts::route('/'),
            'create' => Pages\CreateFeaturedPost::route('/create'),
            'edit' => Pages\EditFeaturedPost::route('/{record}/edit'),
        ];
    }
}
