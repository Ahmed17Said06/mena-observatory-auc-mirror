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
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
                Textarea::make('description')
                    ->hint('Short summary shown on cards and listings.')
                    ->rows(4)
                    ->nullable(),
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
                RichEditor::make('content')
                    ->label('Full Content (Rich Text)')
                    ->hint('Displayed on the resource detail page below the description.')
                    ->nullable()
                    ->columnSpanFull(),

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
                Toggle::make('is_our_work')
                    ->label('Our Work?')
                    ->default(true)
                    ->helperText('Enable if this is produced by our team, disable for external work'),
                Toggle::make('is_global')
                    ->label('Global Work?')
                    ->default(false)
                    ->helperText('For external "Other Work": enable if global scope, leave off for regional scope')
                    ->hidden(fn ($get) => (bool) $get('is_our_work')),

                Toggle::make('is_research')
                    ->label('Research')
                    ->helperText('Original research output (papers, studies, datasets)')
                    ->default(false),
                Toggle::make('is_talk_webinar')
                    ->label('Talks & Webinars')
                    ->helperText('Recorded talks, webinars, or panel discussions')
                    ->default(false),
                Toggle::make('is_educational')
                    ->label('Educational Resources')
                    ->helperText('Tutorials, courses, guides, learning materials')
                    ->default(false),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(60),
                TextColumn::make('repoType.name')
                    ->label('Type')
                    ->sortable(),
                TextColumn::make('country.name')
                    ->sortable(),
                TextColumn::make('publish_date')
                    ->label('Year')
                    ->date('Y')
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('is_our_work')
                    ->label('Our Work')
                    ->action(fn (Repo $record) => $record->update(['is_our_work' => ! $record->is_our_work]))
                    ->tooltip('Click to toggle'),
                Tables\Columns\BooleanColumn::make('is_global')
                    ->label('Global')
                    ->action(fn (Repo $record) => $record->update(['is_global' => ! $record->is_global]))
                    ->tooltip('Click to toggle'),
                Tables\Columns\BooleanColumn::make('is_research')
                    ->label('Research')
                    ->action(fn (Repo $record) => $record->update(['is_research' => ! $record->is_research]))
                    ->tooltip('Click to toggle'),
                Tables\Columns\BooleanColumn::make('is_talk_webinar')
                    ->label('Talk/Webinar')
                    ->action(fn (Repo $record) => $record->update(['is_talk_webinar' => ! $record->is_talk_webinar]))
                    ->tooltip('Click to toggle'),
                Tables\Columns\BooleanColumn::make('is_educational')
                    ->label('Educational')
                    ->action(fn (Repo $record) => $record->update(['is_educational' => ! $record->is_educational]))
                    ->tooltip('Click to toggle'),
            ])
            ->filters([
                SelectFilter::make('classification')
                    ->label('Classification')
                    ->options([
                        'our_work'  => 'Our Work',
                        'regional'  => 'Regional Other Work',
                        'global'    => 'Global Other Work',
                        'none'      => 'Unclassified (is_our_work = null)',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return match ($data['value'] ?? null) {
                            'our_work' => $query->where('is_our_work', true),
                            'regional' => $query->where('is_our_work', false)->where(fn ($q) => $q->where('is_global', false)->orWhereNull('is_global')),
                            'global'   => $query->where('is_our_work', false)->where('is_global', true),
                            'none'     => $query->whereNull('is_our_work'),
                            default    => $query,
                        };
                    }),

                SelectFilter::make('repo_type_id')
                    ->label('Type')
                    ->options(Repo_type::all()->pluck('name', 'id')),

                SelectFilter::make('country_id')
                    ->label('Country')
                    ->options(countries::all()->pluck('name', 'id')),

                SelectFilter::make('format')
                    ->label('Format')
                    ->options([
                        'research'      => 'Research',
                        'talk_webinar'  => 'Talks & Webinars',
                        'educational'   => 'Educational Resources',
                        'unclassified'  => 'Unclassified (none of the three)',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return match ($data['value'] ?? null) {
                            'research'     => $query->where('is_research', true),
                            'talk_webinar' => $query->where('is_talk_webinar', true),
                            'educational'  => $query->where('is_educational', true),
                            'unclassified' => $query->where(fn ($q) => $q->where('is_research', false)->orWhereNull('is_research'))
                                                    ->where(fn ($q) => $q->where('is_talk_webinar', false)->orWhereNull('is_talk_webinar'))
                                                    ->where(fn ($q) => $q->where('is_educational', false)->orWhereNull('is_educational')),
                            default        => $query,
                        };
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('classify_our_work')
                    ->label('Set as Our Work')
                    ->icon('heroicon-o-badge-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Collection $records): void {
                        $records->each(fn (Repo $r) => $r->update(['is_our_work' => true, 'is_global' => false]));
                        Notification::make()->title('Marked as Our Work')->success()->send();
                    }),

                Tables\Actions\BulkAction::make('classify_regional')
                    ->label('Set as Regional Other Work')
                    ->icon('heroicon-o-globe')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->action(function (Collection $records): void {
                        $records->each(fn (Repo $r) => $r->update(['is_our_work' => false, 'is_global' => false]));
                        Notification::make()->title('Marked as Regional Other Work')->warning()->send();
                    }),

                Tables\Actions\BulkAction::make('classify_global')
                    ->label('Set as Global Other Work')
                    ->icon('heroicon-o-globe-alt')
                    ->color('secondary')
                    ->requiresConfirmation()
                    ->action(function (Collection $records): void {
                        $records->each(fn (Repo $r) => $r->update(['is_our_work' => false, 'is_global' => true]));
                        Notification::make()->title('Marked as Global Other Work')->send();
                    }),

                Tables\Actions\BulkAction::make('mark_research')
                    ->label('Mark as Research')
                    ->icon('heroicon-o-academic-cap')
                    ->color('primary')
                    ->requiresConfirmation()
                    ->action(function (Collection $records): void {
                        $records->each(fn (Repo $r) => $r->update(['is_research' => true]));
                        Notification::make()->title('Marked as Research')->success()->send();
                    }),

                Tables\Actions\BulkAction::make('mark_talk_webinar')
                    ->label('Mark as Talks & Webinars')
                    ->icon('heroicon-o-microphone')
                    ->color('primary')
                    ->requiresConfirmation()
                    ->action(function (Collection $records): void {
                        $records->each(fn (Repo $r) => $r->update(['is_talk_webinar' => true]));
                        Notification::make()->title('Marked as Talks & Webinars')->success()->send();
                    }),

                Tables\Actions\BulkAction::make('mark_educational')
                    ->label('Mark as Educational Resources')
                    ->icon('heroicon-o-book-open')
                    ->color('primary')
                    ->requiresConfirmation()
                    ->action(function (Collection $records): void {
                        $records->each(fn (Repo $r) => $r->update(['is_educational' => true]));
                        Notification::make()->title('Marked as Educational Resources')->success()->send();
                    }),

                Tables\Actions\BulkAction::make('clear_format_flags')
                    ->label('Clear Format Flags')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (Collection $records): void {
                        $records->each(fn (Repo $r) => $r->update([
                            'is_research'      => false,
                            'is_talk_webinar'  => false,
                            'is_educational'   => false,
                        ]));
                        Notification::make()->title('Format flags cleared')->send();
                    }),

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
