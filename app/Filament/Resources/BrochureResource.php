<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrochureResource\Pages;
use App\Models\Brochure;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Livewire\TemporaryUploadedFile;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class BrochureResource extends Resource
{
    protected static ?string $model = Brochure::class;

    protected static ?string $modelLabel = 'Brochure';
    protected static ?string $pluralModelLabel = 'Brochures';
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Title (English)')
                    ->required()
                    ->columnSpan('full')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, $livewire) {
                        if ($livewire instanceof \Filament\Resources\Pages\CreateRecord) {
                            $set('slug', \Illuminate\Support\Str::slug($state));
                        }
                    }),
                TextInput::make('ar_title')
                    ->label('Title (Arabic)')
                    ->columnSpan('full'),
                TextInput::make('slug')
                    ->label('URL Slug')
                    ->required()
                    ->unique(Brochure::class, 'slug', ignoreRecord: true)
                    ->helperText('Used in the public URL: /brochure/{slug}')
                    ->columnSpan('full'),
                Textarea::make('description')
                    ->label('Short Description (English)')
                    ->rows(3)
                    ->helperText('Shown in social media link previews')
                    ->columnSpan('full'),
                Textarea::make('ar_description')
                    ->label('Short Description (Arabic)')
                    ->rows(3)
                    ->columnSpan('full'),
                FileUpload::make('image')
                    ->disk('public')
                    ->enableOpen()
                    ->image()
                    ->directory('storage')
                    ->label('Cover Image')
                    ->helperText('Used as the social media preview image (Open Graph)')
                    ->getUploadedFileNameForStorageUsing(
                        function (TemporaryUploadedFile $file): string {
                            $imgName = strtolower(md5($file->getClientOriginalName() . time() . rand(1, 100))
                                . '.' . $file->getClientOriginalExtension());
                            return $file->storeAs('', $imgName, 'public');
                        }),
                FileUpload::make('pdf_file')
                    ->disk('public')
                    ->directory('brochures')
                    ->label('PDF File')
                    ->acceptedFileTypes(['application/pdf'])
                    ->helperText('Optional: uploaded PDF will be available as a download button')
                    ->getUploadedFileNameForStorageUsing(
                        function (TemporaryUploadedFile $file): string {
                            $name = strtolower(md5($file->getClientOriginalName() . time() . rand(1, 100)) . '.pdf');
                            return $file->storeAs('', $name, 'public');
                        }),
                Select::make('is_published')
                    ->label('Published')
                    ->options([1 => 'Yes', 0 => 'No'])
                    ->default(1),
                TinyEditor::make('content')
                    ->label('Content (English)')
                    ->columnSpan('full'),
                TinyEditor::make('ar_content')
                    ->label('Content (Arabic)')
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->limit(60),
                TextColumn::make('slug'),
                BadgeColumn::make('is_published')
                    ->label('Published')
                    ->enum([1 => 'Yes', 0 => 'No'])
                    ->colors(['success' => 1, 'secondary' => 0]),
                TextColumn::make('updated_at')->dateTime('M j, Y')->label('Updated'),
            ])
            ->defaultSort('updated_at', 'desc')
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
            'index'  => Pages\ListBrochures::route('/'),
            'create' => Pages\CreateBrochure::route('/create'),
            'edit'   => Pages\EditBrochure::route('/{record}/edit'),
        ];
    }
}
