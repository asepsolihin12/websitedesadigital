<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenagaKerjaResource\Pages;
use App\Models\TenagaKerja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;

class TenagaKerjaResource extends Resource
{
    protected static ?string $model = TenagaKerja::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'Data Desa';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'Tenaga Kerja';
    protected static ?string $pluralModelLabel = 'Tenaga Kerja';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pribadi')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('jabatan')
                            ->label('Jabatan')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('gambar')
                            ->label('Gambar Utama')
                            ->image()
                            ->directory('public') // Folder penyimpanan
                            ->maxSize(5120) // 5MB
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('450')
                            ->helperText('Format: JPG, PNG, WEBP. Maksimal 5MB. Rasio 9:16 recommended.')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->nullable(), // Bisa kosong
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Kontak & Biodata')
                    ->schema([
                        Forms\Components\TextInput::make('kontak')
                            ->label('Kontak')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Email atau nomor telepon'),

                        Forms\Components\Textarea::make('bio')
                            ->label('Biodata Singkat')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull()
                            ->placeholder('Tulis biodata singkat...'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->disk('public')
                    ->label('Gambar')
                    ->circular()
                    ->size(50)
                    ->defaultImageUrl(url('/images/default-news.jpg')), // Fallback image

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('kontak')
                    ->label('Kontak')
                    ->searchable(),

                Tables\Columns\TextColumn::make('bio')
                    ->label('Biodata')
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jabatan')
                    ->label('Jabatan')
                    ->options([
                        'Kepala Desa' => 'Kepala Desa',
                        'Sekretaris Desa' => 'Sekretaris Desa',
                        'Bendahara' => 'Bendahara',
                        'Staff' => 'Staff',
                    ]),
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
            ->emptyStateHeading('Belum ada data tenaga kerja')
            ->emptyStateDescription('Klik tombol "Tambah" untuk menambahkan data.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTenagaKerjas::route('/'),
            'create' => Pages\CreateTenagaKerja::route('/create'),
            'edit' => Pages\EditTenagaKerja::route('/{record}/edit'),
        ];
    }
}
