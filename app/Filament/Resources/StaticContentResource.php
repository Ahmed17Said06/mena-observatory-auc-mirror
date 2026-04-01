<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaticContentResource\Pages;
use App\Filament\Resources\StaticContentResource\RelationManagers;
use App\Models\static_content;
use App\Models\StaticContent;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\TemporaryUploadedFile;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class StaticContentResource extends Resource
{
    protected static ?string $model = static_content::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                //['key' => 'Intro', 'content' => $def,
                // 'has_media' => 'no', 'width' => null,
                // 'height' => null, 'page' => 'Home'],

                //when we need add a section only
                /////
                TextInput::make('key')->required(),
                Radio::make('has_media')
                    ->label('Has Media?')
                    ->options([
                        'yes' => 'Yes',
                        'no' => 'No',
                    ]),
                TextInput::make('page')->required(),
                ////

                RichEditor::make('content'),
                RichEditor::make('ar_content')->label('Arabic Content'),
                FileUpload::make('media')->disk('public')->enableOpen()->
                directory('storage')
                    ->label('Image')->getUploadedFileNameForStorageUsing(
                        function (TemporaryUploadedFile $file): string {
                            $imgName = strtolower(md5($file->
                                    getClientOriginalName() . time() . rand(1, 100))
                                . '.' . $file->getClientOriginalExtension());
                            return $file->storeAs('', $imgName, 'public');
                        })->maxSize(40960),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page'),
                TextColumn::make('Title')->name('key'),
                TextColumn::make('content')->limit(25),
                TextColumn::make('ar_content')->limit(25)->label('Arabic content')

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
            'index' => Pages\ListStaticContents::route('/'),
            'create' => Pages\CreateStaticContent::route('/create'),
            'edit' => Pages\EditStaticContent::route('/{record}/edit'),
        ];
    }
}
