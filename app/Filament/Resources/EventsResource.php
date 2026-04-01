<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventsResource\Pages;
use App\Models\Events;
use App\Models\Repo_tags;
use Filament\Forms\Components\DateTimePicker;
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

class EventsResource extends Resource
{
    protected static ?string $model = Events::class;

    protected static ?string $modelLabel = 'Event';
    protected static ?string $pluralModelLabel = 'Events';
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required()->columnSpan('full'),
                TextInput::make('description')->columnSpan('full'),
                Select::make('type')
                    ->options([
                        'In Person' => 'In Person',
                        'Online'    => 'Online',
                        'Hybrid'    => 'Hybrid',
                    ])->required(),
                Select::make('featured')
                    ->options([
                        'no'  => 'No',
                        'yes' => 'Yes',
                    ])->default('no'),
                DateTimePicker::make('start_date')->required(),
                DateTimePicker::make('end_date'),
                TextInput::make('location'),
                TextInput::make('gmaps_url')->label('Google Maps URL')->url(),
                FileUpload::make('image')
                    ->disk('public')
                    ->enableOpen()
                    ->image()
                    ->directory('storage')
                    ->label('Image')
                    ->getUploadedFileNameForStorageUsing(
                        function (TemporaryUploadedFile $file): string {
                            $imgName = strtolower(md5($file->getClientOriginalName() . time() . rand(1, 100))
                                . '.' . $file->getClientOriginalExtension());
                            return $file->storeAs('', $imgName, 'public');
                        }),
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
                TextColumn::make('title')->searchable()->limit(60),
                TextColumn::make('start_date')->dateTime('M j, Y')->sortable(),
                TextColumn::make('type'),
                Tables\Columns\BadgeColumn::make('featured')
                    ->colors(['success' => 'yes', 'secondary' => 'no']),
            ])
            ->defaultSort('start_date', 'desc')
            ->filters([])
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
            'index'  => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvents::route('/create'),
            'edit'   => Pages\EditEvents::route('/{record}/edit'),
        ];
    }
}
