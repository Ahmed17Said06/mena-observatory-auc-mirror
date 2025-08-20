<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewWorkBlogResource\Pages;
use App\Models\NewWorkBlog;
use App\Models\countries;
use App\Models\Repo_tags;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Livewire\TemporaryUploadedFile;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class NewWorkBlogResource extends Resource
{
    protected static ?string $model = NewWorkBlog::class;
    protected static ?string $modelLabel = 'New Work Blog';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationLabel = 'New Work Blogs';
    
    protected static ?string $pluralModelLabel = 'New Work Blogs';
    
    protected static ?string $navigationGroup = 'New Work';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                TextInput::make('description')
                    ->hint(fn($state, $component) => 'left: ' . $component->getMaxLength() - strlen($state) . ' characters')
                    ->maxlength(160)
                    ->reactive(),
                TinyEditor::make('content')->required(),
                DatePicker::make('publish_date')->format('Y-m-d')->required(),
                FileUpload::make('image')->disk('public')->enableOpen()->required()->image()->
                directory('storage')
                    ->label('Image')->getUploadedFileNameForStorageUsing(
                        function (TemporaryUploadedFile $file): string {
                            $imgName = strtolower(md5($file->
                                    getClientOriginalName() . time() . rand(1, 100))
                                . '.' . $file->getClientOriginalExtension());
                            return $file->storeAs('', $imgName, 'public');
                        }),

                Select::make('country_id')
                    ->label('Country')
                    ->options(countries::all()->pluck('name', 'id'))
                    ->required(),
                Select::make('tags')
                    ->options(Repo_tags::all()->pluck('name', 'id')->toArray())
                    ->multiple()
                    ->placeholder('Choose tags...')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('description')->limit(25),
                ImageColumn::make('image'),
                TextColumn::make('country.name')->label('Country'),
                TextColumn::make('publish_date')->date(),
                TextColumn::make('views'),
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
            'index' => Pages\ListNewWorkBlog::route('/'),
            'create' => Pages\CreateNewWorkBlog::route('/create'),
            'edit' => Pages\EditNewWorkBlog::route('/{record}/edit'),
        ];
    }
}