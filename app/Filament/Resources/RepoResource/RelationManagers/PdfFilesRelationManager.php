<?php

namespace App\Filament\Resources\RepoResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\TemporaryUploadedFile;

class PdfFilesRelationManager extends RelationManager
{
    protected static string $relationship = 'pdfFiles';

    protected static ?string $recordTitleAttribute = 'repo_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('description'),
                FileUpload::make('image')->disk('public')->enableOpen()->
                image()->
                directory('storage')->label('Image')->
                getUploadedFileNameForStorageUsing(
                    function (TemporaryUploadedFile $file): string {
                        $imgName = strtolower(md5($file->
                                getClientOriginalName() . time() . rand(1, 100))
                            . '.' . $file->getClientOriginalExtension());
                        return $file->storeAs('', $imgName, 'public');
                    })->required(),
                FileUpload::make('file')->acceptedFileTypes(['application/pdf'])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                Tables\Columns\TextColumn::make('repo_id'),
                TextColumn::make('name'),
                TextColumn::make('description')->limit(40),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
