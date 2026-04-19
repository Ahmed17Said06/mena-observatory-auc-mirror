<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\Community;
use App\Models\countries;
use App\Models\News;
use App\Models\Repo_tags;
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
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $modelLabel = 'News';
    protected static ?string $pluralLabel = 'News';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required()->columnSpan('full'),
                TextInput::make('description')
                    ->hint(fn ($state, $component) => 'left: ' . ($component->getMaxLength() - strlen($state)) . ' characters')
                    ->maxlength(200)
                    ->reactive()
                    ->columnSpan('full'),
                TextInput::make('data_link')
                    ->label('External Link (URL)')
                    ->url()
                    ->nullable()
                    ->helperText('Optional: link to an external page or event. If set, clicking the news card will open this URL.')
                    ->columnSpan('full'),
                FileUpload::make('image')
                    ->disk('public')
                    ->enableOpen()
                    ->image()
                    ->directory('storage')
                    ->label('Image / Flyer')
                    ->getUploadedFileNameForStorageUsing(
                        function (TemporaryUploadedFile $file): string {
                            $imgName = strtolower(md5($file->getClientOriginalName() . time() . rand(1, 100))
                                . '.' . $file->getClientOriginalExtension());
                            return $file->storeAs('', $imgName, 'public');
                        }),
                DatePicker::make('date')->format('Y-m-d')->required(),
                Select::make('country_id')
                    ->label('Country')
                    ->options(countries::all()->pluck('name', 'id'))
                    ->required(),
                Select::make('featured')
                    ->options([
                        'no'  => 'No',
                        'yes' => 'Yes',
                    ])
                    ->default('no'),
                TinyEditor::make('content')->required()->columnSpan('full'),
                Select::make('tags')
                    ->options(Repo_tags::all()->pluck('name', 'id')->toArray())
                    ->multiple()
                    ->placeholder('Choose tags...'),
                Select::make('communities')
                    ->relationship('communities', 'name')
                    ->options(Community::all()->pluck('name', 'id')->toArray())
                    ->multiple()
                    ->placeholder('Choose participating communities'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->limit(60),
                TextColumn::make('date')->date('M j, Y')->sortable(),
                TextColumn::make('country.name')->label('Country'),
                Tables\Columns\BooleanColumn::make('data_link')
                    ->label('Has Link')
                    ->getStateUsing(fn (News $record) => (bool) $record->data_link),
                Tables\Columns\BadgeColumn::make('featured')
                    ->colors(['success' => 'yes', 'secondary' => 'no']),
            ])
            ->defaultSort('date', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index'  => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit'   => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
