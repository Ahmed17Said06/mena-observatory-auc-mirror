<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GenderAiResource\Pages;
use App\Filament\Resources\GenderAiResource\RelationManagers;
use App\Models\GenderAi;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\TemporaryUploadedFile;

class GenderAiResource extends Resource
{
    protected static ?string $model = GenderAi::class;
    protected static ?string $modelLabel = 'Gender & AI';

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
                TextInput::make('link')->label('Link')->url()->required(),
//                Toggle::make('featured'),
                Select::make('featured_type')
                    ->options([
                        'none' => 'None',
                        'feminist_ai' => 'Feminist AI',
                        'pw_mena' => 'PW MENA',
                    ])->nullable(),
                FileUpload::make('thumbnail_image')->disk('public')->required()->enableOpen()->image()->
                directory('storage')
                    ->label('Image')->getUploadedFileNameForStorageUsing(
                        function (TemporaryUploadedFile $file): string {
                            $imgName = strtolower(md5($file->
                                    getClientOriginalName() . time() . rand(1, 100))
                                . '.' . $file->getClientOriginalExtension());
                            return $file->storeAs('', $imgName, 'public');
                        }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                SelectColumn::make('featured_type')
                    ->options([
                        'none' => 'None',
                        'feminist_ai' => 'Feminist AI',
                        'pw_mena' => 'PW MENA',
                    ]),
//                ToggleColumn::make('featured'),
                TextColumn::make('link')->label('Link'),
                TextColumn::make('description')->limit(25)
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
            'index' => Pages\ListGenderAis::route('/'),
            'create' => Pages\CreateGenderAi::route('/create'),
            'edit' => Pages\EditGenderAi::route('/{record}/edit'),
        ];
    }
}
