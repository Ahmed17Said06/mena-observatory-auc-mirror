<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewWorkBlogResource\Pages;
use App\Models\NewWorkBlog;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Livewire\TemporaryUploadedFile;

class NewWorkBlogResource extends Resource
{
    protected static ?string $model = NewWorkBlog::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationLabel = 'New Work Blogs';
    
    protected static ?string $pluralModelLabel = 'New Work Blogs';
    
    protected static ?string $navigationGroup = 'New Work';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                    
                Textarea::make('description')
                    ->maxLength(65535),
                    
                FileUpload::make('file_path')
                    ->label('File')
                    ->disk('public')
                    ->directory('new_work_blogs/files')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(10240)
                    ->getUploadedFileNameForStorageUsing(
                        function (TemporaryUploadedFile $file): string {
                            $fileName = strtolower(md5($file->getClientOriginalName() . time() . rand(1, 100))
                                . '.' . $file->getClientOriginalExtension());
                            return $fileName;
                        }
                    ),
                    
                DateTimePicker::make('published_at')
                    ->label('Publish Date')
                    ->nullable(),
                    
                FileUpload::make('image_path')
                    ->label('Featured Image')
                    ->disk('public')
                    ->directory('new_work_blogs/images')
                    ->image()
                    ->maxSize(5120)
                    ->getUploadedFileNameForStorageUsing(
                        function (TemporaryUploadedFile $file): string {
                            $imgName = strtolower(md5($file->getClientOriginalName() . time() . rand(1, 100))
                                . '.' . $file->getClientOriginalExtension());
                            return $imgName;
                        }
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('description')
                    ->limit(50),
                    
                ImageColumn::make('image_path')
                    ->label('Image'),
                    
                TextColumn::make('published_at')
                    ->label('Published')
                    ->dateTime()
                    ->sortable(),
                    
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
