<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PolicyBriefResource\Pages;
use App\Models\PolicyBrief;
use App\Models\countries;
use App\Models\Repo_type;
use App\Models\Repo_tags;
use App\Models\Community;
use App\Models\Author;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Livewire\TemporaryUploadedFile;

class PolicyBriefResource extends Resource
{
    protected static ?string $model = PolicyBrief::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

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
                DatePicker::make('publish_date')->format('Y-m-d'),

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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPolicyBriefs::route('/'),
            'create' => Pages\CreatePolicyBrief::route('/create'),
            'edit' => Pages\EditPolicyBrief::route('/{record}/edit'),
        ];
    }
}
