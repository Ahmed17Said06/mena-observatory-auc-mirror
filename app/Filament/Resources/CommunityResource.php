<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommunityResource\Pages;
use App\Filament\Resources\CommunityResource\RelationManagers;
use App\Models\CommunitiesTags;
use App\Models\Community;
use App\Models\Interests;
use App\Models\Repo_tags;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Livewire\TemporaryUploadedFile;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class CommunityResource extends Resource
{
    protected static ?string $model = Community::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'People / Community';
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('description')->required(),
                RichEditor::make('content')->required(),
                FileUpload::make('image')->disk('public')->enableOpen()->image()->
                directory('storage')
                    ->label('Profile Image')->getUploadedFileNameForStorageUsing(
                        function (TemporaryUploadedFile $file): string {
                            $imgName = strtolower(md5($file->
                                    getClientOriginalName() . time() . rand(1, 100))
                                . '.' . $file->getClientOriginalExtension());
                            return $file->storeAs('', $imgName, 'public');
                        }),
                FileUpload::make('thumbnail_image')->disk('public')->enableOpen()->image()->
                directory('storage')
                    ->label('Thumbnail Image')->getUploadedFileNameForStorageUsing(
                        function (TemporaryUploadedFile $file): string {
                            $imgName = strtolower(md5($file->
                                    getClientOriginalName() . time() . rand(1, 100))
                                . '.' . $file->getClientOriginalExtension());
                            return $file->storeAs('', $imgName, 'public');
                        }),
                TextInput::make('twitter_link')->url(),
                TextInput::make('facebook_link')->url(),
                TextInput::make('linkedin_link')->url(),
//                Select::make('tags')
//                    ->options(CommunitiesTags::all()->pluck('name', 'id')->toArray())
//                    ->multiple()
//                    ->placeholder('Choose tags...')
                Select::make('interests')->
                relationship('interests', 'name')->multiple()
                    ->options(Interests::all()->pluck('name', 'id')->toArray())
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required(),
                    ]),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('description')->limit(25),
                TextColumn::make('created_at')->dateTime(),

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
//            RelationManagers\InterestsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCommunities::route('/'),
            'create' => Pages\CreateCommunity::route('/create'),
            'edit' => Pages\EditCommunity::route('/{record}/edit'),
        ];
    }
}
