<?php
//
//namespace App\Filament\Resources;
//
//use App\Filament\Resources\AdditionalResource\Pages;
//use App\Filament\Resources\AdditionalResource\RelationManagers;
//use App\Models\Additional;
//use App\Models\AdditionalResource;
//use App\Models\countries;
//use App\Models\Repo_tags;
//use Filament\Forms;
//use Filament\Forms\Components\FileUpload;
//use Filament\Forms\Components\Select;
//use Filament\Forms\Components\TextInput;
//use Filament\Resources\Form;
//use Filament\Resources\Resource;
//use Filament\Resources\Table;
//use Filament\Tables;
//use Filament\Tables\Columns\TextColumn;
//use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Database\Eloquent\SoftDeletingScope;
//use Livewire\TemporaryUploadedFile;
//use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
//
//class AdditionalResourceResource extends Resource
//{
//    protected static ?string $model = AdditionalResource::class;
//
//    protected static ?string $navigationIcon = 'heroicon-o-collection';
//
//    public static function form(Form $form): Form
//    {
//        return $form
//            ->schema([
//                TextInput::make('title')->required(),
//                TextInput::make('description'),
//                TextInput::make('data_link')->label('Link')->url()->required(),
////                TinyEditor::make('content')->required(),
//                FileUpload::make('image')->disk('public')->required()->enableOpen()->image()->
//                directory('storage')
//                    ->label('Image')->getUploadedFileNameForStorageUsing(
//                        function (TemporaryUploadedFile $file): string {
//                            $imgName = strtolower(md5($file->
//                                    getClientOriginalName() . time() . rand(1, 100))
//                                . '.' . $file->getClientOriginalExtension());
//                            return $file->storeAs('', $imgName, 'public');
//                        }),
//
//                Select::make('country_id')
//                    ->label('Country')
//                    ->options(countries::all()->pluck('name', 'id')),
//
////                Select::make('tags')
////                    ->options(Repo_tags::all()->pluck('name', 'id')->toArray())
////                    ->multiple()
////                    ->placeholder('Choose tags...'),
////                FileUpload::make('file')->acceptedFileTypes(['application/pdf']),
//
//            ]);
//    }
//
//    public static function table(Table $table): Table
//    {
//        return $table
//            ->columns([
//                TextColumn::make('title'),
//                TextColumn::make('link')->label('Link'),
//                TextColumn::make('description')->limit(25)
//            ])
//            ->filters([
//                //
//            ])
//            ->actions([
//                Tables\Actions\EditAction::make(),
//            ])
//            ->bulkActions([
//                Tables\Actions\DeleteBulkAction::make(),
//            ]);
//    }
//
//    public static function getRelations(): array
//    {
//        return [
//            //
//        ];
//    }
//
//    public static function getPages(): array
//    {
//        return [
//            'index' => Pages\ListAdditionals::route('/'),
//            'create' => Pages\CreateAdditional::route('/create'),
//            'edit' => Pages\EditAdditional::route('/{record}/edit'),
//        ];
//    }
//}
