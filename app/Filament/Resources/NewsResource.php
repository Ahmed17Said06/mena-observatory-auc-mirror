<?php
//
//namespace App\Filament\Resources;
//
//use App\Filament\Resources\NewsResource\Pages;
//use App\Filament\Resources\NewsResource\RelationManagers;
//use App\Models\Community;
//use App\Models\countries;
//use App\Models\News;
//use App\Models\Repo_tags;
//use Filament\Forms;
//use Filament\Forms\Components\DatePicker;
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
//class NewsResource extends Resource
//{
//    protected static ?string $model = News::class;
//
//    protected static ?string $navigationIcon = 'heroicon-o-collection';
//
//    public static function form(Form $form): Form
//    {
//        return $form
//            ->schema([
//                TextInput::make('title')->required(),
//                TextInput::make('description'),
//                FileUpload::make('image')->disk('public')->enableOpen()->image()->
//                directory('storage')
//                    ->label('Image')->getUploadedFileNameForStorageUsing(
//                        function (TemporaryUploadedFile $file): string {
//                            $imgName = strtolower(md5($file->
//                                    getClientOriginalName() . time() . rand(1, 100))
//                                . '.' . $file->getClientOriginalExtension());
//                            return $file->storeAs('', $imgName, 'public');
//                        })->required(),
//                Select::make('country_id')
//                    ->label('Country')
//                    ->options(countries::all()->pluck('name', 'id')),
//                DatePicker::make('date')->format('Y-m-d')->required(),
//                TinyEditor::make('content')->required(),
//
//                Select::make('featured')
//                    ->options([
//                        'no' => 'no',
//                        'yes' => 'yes',
//                    ]),
//                Select::make('tags')
//                    ->options(Repo_tags::all()->pluck('name', 'id')->toArray())
//                    ->multiple()
//                    ->placeholder('Choose tags...'),
//                Select::make('communities')
//                    ->relationship('communities', 'name',)
//                    ->options(Community::all()->pluck('name', 'id')->toArray())
//                    ->multiple()
//                    ->placeholder('Choose participating communities'),
//            ]);
//    }
//
//    public static function table(Table $table): Table
//    {
//        return $table
//            ->columns([
//                TextColumn::make('title'),
//                TextColumn::make('description')->limit(25),
//                TextColumn::make('created_at')->dateTime(),
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
//            'index' => Pages\ListNews::route('/'),
//            'create' => Pages\CreateNews::route('/create'),
//            'edit' => Pages\EditNews::route('/{record}/edit'),
//        ];
//    }
//}
