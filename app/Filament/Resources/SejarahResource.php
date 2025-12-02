<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SejarahResource\Pages;
use App\Models\Sejarah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SejarahResource extends Resource
{
    protected static ?string $model = Sejarah::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 5;
    protected static ?string $modelLabel = 'Sejarah';
    protected static ?string $pluralModelLabel = 'Sejarah Desa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Sejarah Desa')
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->label('Judul Periode')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('isi')
                            ->label('Deskripsi Sejarah')
                            ->required()
                            ->rows(6)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('tahun')
                            ->label('Tahun')
                            ->numeric()
                            ->required()
                            ->minValue(1900)
                            ->maxValue(now()->year),
                    ]),
                
                Forms\Components\Section::make('Gambar Sejarah')
                    ->schema([
                        Forms\Components\FileUpload::make('gambar')
                            ->label('Gambar')
                            ->image()
                            ->directory('sejarah')
                            ->maxSize(5120)
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('450')
                            ->helperText('Format: JPG, PNG, WEBP. Maksimal 5MB.')
                            ->nullable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->circular()
                    ->size(50),
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('tahun')
                    ->label('Tahun')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada sejarah desa')
            ->emptyStateDescription('Klik tombol "Tambah" untuk menambahkan sejarah.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSejarahs::route('/'),
            'create' => Pages\CreateSejarah::route('/create'),
            'edit' => Pages\EditSejarah::route('/{record}/edit'),
        ];
    }
}