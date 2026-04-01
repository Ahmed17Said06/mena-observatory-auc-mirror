<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogsResource\Pages;
use App\Models\Blogs;
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

class BlogsResource extends Resource
{
    protected static ?string $model = Blogs::class;
    protected static ?string $modelLabel = 'Post';

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
                TinyEditor::make('content')->required(),
                DatePicker::make('publish_date')->format('Y-m-d')->required(),
//                Select::make('featured')
//                    ->options([
//                        'no' => 'no',
//                        'yes' => 'yes',
//                    ]),
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
                ImageColumn::make('image')
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlogs::route('/create'),
            'edit' => Pages\EditBlogs::route('/{record}/edit'),
        ];
    }
}
