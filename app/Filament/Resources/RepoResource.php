<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RepoResource\Pages;
use App\Models\Author;
use App\Models\Community;
use App\Models\countries;
use App\Models\Repo;
use App\Models\Repo_tags;
use App\Models\Repo_theme;
use App\Models\Repo_type;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Livewire\TemporaryUploadedFile;

class RepoResource extends Resource
{
    protected static ?string $model = Repo::class;

    protected static ?string $modelLabel = 'Knowledge Hub';
    protected static ?string $pluralLabel = 'Knowledge Hub';
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
                TextInput::make('data_link')->label('link')->nullable(),
                FileUpload::make('image')->disk('public')->enableOpen()->image()->
                directory('storage')->required()
                    ->label('Image')->getUploadedFileNameForStorageUsing(
                        function (TemporaryUploadedFile $file): string {
                            $imgName = strtolower(md5($file->
                                    getClientOriginalName() . time() . rand(1, 100))
                                . '.' . $file->getClientOriginalExtension());
                            return $file->storeAs('', $imgName, 'public');
                        }),
//                FileUpload::make('file')->acceptedFileTypes(['application/pdf']),
                DatePicker::make('publish_date')->format('Y-m-d'),
//                RichEditor::make('content'),

                Select::make('authors')
                    ->relationship('authors', 'name',)
                    ->options(Author::all()->pluck('name', 'id')->toArray())
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required(),
                    ])
                    ->multiple(),
                TextInput::make('field'),
                TextInput::make('project'),
                TextInput::make('subject'),

                Select::make('country_id')
                    ->label('Country')
                    ->options(countries::all()->pluck('name', 'id'))->required(),
//                Select::make('repo_theme_id')
//                    ->label('Theme')
//                    ->options(Repo_theme::all()->pluck('name', 'id')),
                Select::make('repo_type_id')
                    ->label('repo type')
                    ->options(Repo_type::all()->pluck('name', 'id'))->required(),
                Select::make('tags')
                    ->options(Repo_tags::all()->pluck('name', 'id')->toArray())
                    ->multiple()
                    ->placeholder('Choose tags...'),
                Select::make('communities')
                    ->relationship('communities', 'name',)
                    ->options(Community::all()->pluck('name', 'id')->toArray())
                    ->multiple()
                    ->placeholder('Choose participating communities..'),
                FileUpload::make('ar_pdf')->acceptedFileTypes(['application/pdf']),
                FileUpload::make('en_pdf')->acceptedFileTypes(['application/pdf']),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('country.name'),


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
//            RelationManagers\PdfFilesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRepos::route('/'),
            'create' => Pages\CreateRepo::route('/create'),
            'edit' => Pages\EditRepo::route('/{record}/edit'),
        ];
    }
}
