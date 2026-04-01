<?php
//
//namespace App\Filament\Resources;
//
//use App\Filament\Resources\EventsResource\Pages;
//use App\Filament\Resources\EventsResource\RelationManagers;
//use App\Models\Community;
//use App\Models\Events;
//use App\Models\Repo_tags;
//use Filament\Forms;
//use Filament\Forms\Components\DatePicker;
//use Filament\Forms\Components\DateTimePicker;
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
//
//class EventsResource extends Resource
//{
//    protected static ?string $model = Events::class;
//
//    protected static ?string $navigationIcon = 'heroicon-o-collection';
//
//    public static function form(Form $form): Form
//    {
//        return $form
//            ->schema([
//                TextInput::make('title')->required(),
//                TextInput::make('description'),
//                Select::make('type')
//                    ->options([
//                        'In Person' => 'In Person',
//                        'Online' => 'Online',
//                        'Hybrid' => "Hybrid",
//                    ])->required(),
//                DateTimePicker::make('start_date')->required(),
//                DateTimePicker::make('end_date'),
//                TextInput::make('location')->required(),
//
//                TextInput::make('Google maps location')->name('gmaps_url')->url(),
//                Select::make('featured')
//                    ->options([
//                        'no' => 'no',
//                        'yes' => 'yes',
//                    ]),
//                FileUpload::make('image')->disk('public')->enableOpen()->image()->
//                directory('storage')
//                    ->label('Image')->getUploadedFileNameForStorageUsing(
//                        function (TemporaryUploadedFile $file): string {
//                            $imgName = strtolower(md5($file->
//                                    getClientOriginalName() . time() . rand(1, 100))
//                                . '.' . $file->getClientOriginalExtension());
//                            return $file->storeAs('', $imgName, 'public');
//                        }),
//                Select::make('tags')
//                    ->options(Repo_tags::all()->pluck('name', 'id')->toArray())
//                    ->multiple()
//                    ->placeholder('Choose tags...'),
//
//            ]);
//    }
//
//    public static function table(Table $table): Table
//    {
//        return $table
//            ->columns([
//                TextColumn::make('title'),
//                TextColumn::make('description')->limit(25),
//                TextColumn::make('start_date')->dateTime(),
//                TextColumn::make('end_date')->dateTime()
//
//
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
//            'index' => Pages\ListEvents::route('/'),
//            'create' => Pages\CreateEvents::route('/create'),
//            'edit' => Pages\EditEvents::route('/{record}/edit'),
//        ];
//    }
//}
