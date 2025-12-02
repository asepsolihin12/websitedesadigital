<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Models\Berita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Berita';
    protected static ?string $pluralModelLabel = 'Berita Desa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Berita')
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->label('Judul Berita')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Pembangunan Jalan Desa Selesai'),
                        Forms\Components\Textarea::make('isi')
                            ->label('Isi Berita')
                            ->required()
                            ->rows(8)
                            ->columnSpanFull()
                            ->placeholder('Tulis isi berita lengkap di sini...'),
                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal Berita')
                            ->required()
                            ->default(now())
                            ->maxDate(now()),
                        Forms\Components\TextInput::make('penulis')
                            ->label('Penulis')
                            ->required()
                            ->maxLength(255)
                            ->default('Admin Desa'),
                    ]),
                
                Forms\Components\Section::make('Gambar Berita')
                    ->schema([
                        Forms\Components\FileUpload::make('gambar')
                            ->label('Gambar Utama')
                            ->image()
                            ->directory('berita') // Folder penyimpanan
                            ->maxSize(5120) // 5MB
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('450')
                            ->helperText('Format: JPG, PNG, WEBP. Maksimal 5MB. Rasio 16:9 recommended.')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->nullable(), // Bisa kosong
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
                    ->size(50)
                    ->defaultImageUrl(url('/images/default-news.jpg')), // Fallback image
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->wrap(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('penulis')
                    ->label('Penulis')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
    Tables\Filters\SelectFilter::make('penulis')
        ->label('Filter Penulis')
        ->options([
            'Admin Desa' => 'Admin Desa',
            'Petugas Desa' => 'Petugas Desa',
        ]),
    Tables\Filters\Filter::make('tanggal')
        ->form([
            Forms\Components\DatePicker::make('dari_tanggal'),
            Forms\Components\DatePicker::make('sampai_tanggal'),
        ])
        ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data): \Illuminate\Database\Eloquent\Builder {
            return $query
                ->when(
                    $data['dari_tanggal'],
                    fn (\Illuminate\Database\Eloquent\Builder $query, $date): \Illuminate\Database\Eloquent\Builder => $query->whereDate('tanggal', '>=', $date),
                )
                ->when(
                    $data['sampai_tanggal'],
                    fn (\Illuminate\Database\Eloquent\Builder $query, $date): \Illuminate\Database\Eloquent\Builder => $query->whereDate('tanggal', '<=', $date),
                );
        }),
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
            ->emptyStateHeading('Belum ada berita')
            ->emptyStateDescription('Klik tombol "Tambah" untuk menambahkan berita baru.');
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}