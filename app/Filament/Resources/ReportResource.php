<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Models\Report;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Livewire\TemporaryUploadedFile;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;
    protected static ?string $modelLabel = 'Report';
    protected static ?string $navigationIcon = 'heroicon-o-document-report';
    protected static ?string $navigationGroup = 'New Work';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title'),
                TextInput::make('ar_title')->label('Arabic Title'),
                TinyEditor::make('description')->required(),
                TinyEditor::make('ar_description')->label('Arabic Description'),
                DateTimePicker::make('published_at')->label('Publish Date & Time'),
                FileUpload::make('file_path')
                    ->disk('public')
                    ->directory('reports/files')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(10240)
                    ->label('PDF File')
                    ->required()
                    ->getUploadedFileNameForStorageUsing(
                        function (TemporaryUploadedFile $file): string {
                            $fileName = strtolower(md5($file->getClientOriginalName() . time() . rand(1, 100)))
                                . '.' . $file->getClientOriginalExtension();
                            return $file->storeAs('', $fileName, 'public');
                        }
                    ),
                FileUpload::make('image_path')
                    ->disk('public')
                    ->directory('reports/images')
                    ->image()
                    ->maxSize(2048)
                    ->label('Thumbnail Image')
                    ->required()
                    ->getUploadedFileNameForStorageUsing(
                        function (TemporaryUploadedFile $file): string {
                            $imgName = strtolower(md5($file->getClientOriginalName() . time() . rand(1, 100)))
                                . '.' . $file->getClientOriginalExtension();
                            return $file->storeAs('', $imgName, 'public');
                        }
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('description')->limit(50)->html(),
                ImageColumn::make('image_path'),
                TextColumn::make('published_at')->dateTime(),
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
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}
