<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PwMenaPublicationResource\Pages;
use App\Models\PwMenaPublication;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;

class PwMenaPublicationResource extends Resource
{
    protected static ?string $model = PwMenaPublication::class;

    protected static ?string $modelLabel = 'Publication';

    protected static ?string $pluralModelLabel = 'PW-MENA Publications';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'New Work';

    protected static ?string $navigationLabel = 'PW-MENA Publications';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Title (EN)')
                    ->required()
                    ->columnSpan(2),

                TextInput::make('ar_title')
                    ->label('Title (AR)')
                    ->nullable()
                    ->columnSpan(2),

                Textarea::make('description')
                    ->label('Short Description')
                    ->hint('Shown on the card listing. Keep under ~300 characters.')
                    ->rows(3)
                    ->nullable()
                    ->columnSpan(2),

                RichEditor::make('content')
                    ->label('Full Content (Rich Text)')
                    ->hint('Optional — for blog posts or detailed write-ups. Shown as an expandable section on the page.')
                    ->nullable()
                    ->columnSpanFull(),

                Select::make('type')
                    ->options([
                        'report' => 'Report',
                        'brief'  => 'Policy Brief',
                        'blog'   => 'Blog Post',
                    ])
                    ->required()
                    ->default('report'),

                TextInput::make('tag')
                    ->label('Country / Region Tag')
                    ->placeholder('e.g. Egypt, Jordan, MENA')
                    ->nullable(),

                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0),

                TextInput::make('link_en')
                    ->label('EN PDF Link')
                    ->hint('Paste a full URL (https://...) or a server path (/docs/egypt/file.pdf)')
                    ->nullable()
                    ->columnSpan(2),

                FileUpload::make('file_en')
                    ->label('Or upload EN PDF')
                    ->disk('public')
                    ->directory('publications')
                    ->acceptedFileTypes(['application/pdf'])
                    ->nullable()
                    ->columnSpan(2),

                TextInput::make('link_ar')
                    ->label('AR PDF Link')
                    ->nullable()
                    ->columnSpan(2),

                FileUpload::make('file_ar')
                    ->label('Or upload AR PDF')
                    ->disk('public')
                    ->directory('publications')
                    ->acceptedFileTypes(['application/pdf'])
                    ->nullable()
                    ->columnSpan(2),

                TextInput::make('link_fr')
                    ->label('FR PDF Link')
                    ->nullable()
                    ->columnSpan(2),

                FileUpload::make('file_fr')
                    ->label('Or upload FR PDF')
                    ->disk('public')
                    ->directory('publications')
                    ->acceptedFileTypes(['application/pdf'])
                    ->nullable()
                    ->columnSpan(2),

                TextInput::make('external_link')
                    ->label('Card Link (single URL)')
                    ->hint('Use this for blog posts or reports with a single clickable link instead of language buttons')
                    ->nullable()
                    ->columnSpan(2),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('#')->sortable(),
                BadgeColumn::make('type')
                    ->colors([
                        'warning' => 'report',
                        'primary' => 'brief',
                        'info'    => 'blog',
                    ]),
                TextColumn::make('title')->limit(60)->searchable(),
                TextColumn::make('tag')->label('Country'),
                TextColumn::make('link_en')->label('EN Link')->limit(30),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'report' => 'Reports',
                        'brief'  => 'Policy Briefs',
                        'blog'   => 'Blog Posts',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPwMenaPublications::route('/'),
            'create' => Pages\CreatePwMenaPublication::route('/create'),
            'edit'   => Pages\EditPwMenaPublication::route('/{record}/edit'),
        ];
    }
}
