<?php

namespace App\Filament\Resources;

use App\Filament\Resources\YoutubeVideoResource\Pages;
use App\Models\Repo_tags;
use App\Models\YoutubeVideo;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;

class YoutubeVideoResource extends Resource
{
    protected static ?string $model = YoutubeVideo::class;

    protected static ?string $modelLabel = 'YouTube Video';
    protected static ?string $pluralLabel = 'YouTube Videos';
    protected static ?string $navigationIcon = 'heroicon-o-video-camera';
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->label('Title (English)')
                    ->placeholder('Enter video title in English'),
                TextInput::make('ar_title')
                    ->label('Title (Arabic)')
                    ->placeholder('Enter video title in Arabic'),
                TextInput::make('youtube_url')
                    ->required()
                    ->label('YouTube URL')
                    ->placeholder('https://www.youtube.com/watch?v=...')
                    ->helperText('Paste the full YouTube video URL')
                    ->url(),
                Textarea::make('description')
                    ->label('Description (English)')
                    ->rows(3),
                Textarea::make('ar_description')
                    ->label('Description (Arabic)')
                    ->rows(3),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear first'),
                Toggle::make('is_published')
                    ->label('Published')
                    ->default(true),
                Select::make('tags')
                    ->options(Repo_tags::all()->pluck('name', 'id')->toArray())
                    ->multiple()
                    ->placeholder('Choose tags...'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('youtube_url')
                    ->label('URL')
                    ->limit(40),
                BooleanColumn::make('is_published')
                    ->label('Published'),
                TextColumn::make('sort_order')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime('M d, Y')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListYoutubeVideos::route('/'),
            'create' => Pages\CreateYoutubeVideo::route('/create'),
            'edit' => Pages\EditYoutubeVideo::route('/{record}/edit'),
        ];
    }
}
