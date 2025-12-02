<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroResource\Pages;
use App\Models\Hero;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HeroResource extends Resource
{
    protected static ?string $model = Hero::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Hero Section';
    protected static ?string $pluralModelLabel = 'Hero Section';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Konten Hero Section')
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->label('Judul Utama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subjudul')
                            ->label('Sub Judul')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Gambar Background')
                    ->schema([
                        Forms\Components\FileUpload::make('gambar')
    ->label('Gambar Hero')
    ->image()
    ->disk('public')
    ->directory('hero')
    ->maxSize(5120)
    ->imageResizeMode('cover')
    ->imageCropAspectRatio('16:9')
    ->imageResizeTargetWidth('1200')
    ->imageResizeTargetHeight('600')
    ->helperText('Format: JPG, PNG, WEBP. Maksimal 5MB.')
    ->required(),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
    ->label('Gambar')
    ->disk('public')
    ->height(60)
    ->width(100),
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('subjudul')
                    ->label('Sub Judul')
                    ->searchable()
                    ->limit(50),
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
            ->emptyStateHeading('Belum ada hero section')
            ->emptyStateDescription('Klik tombol "Tambah" untuk membuat hero section.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroes::route('/'),
            'create' => Pages\CreateHero::route('/create'),
            'edit' => Pages\EditHero::route('/{record}/edit'),
        ];
    }
}