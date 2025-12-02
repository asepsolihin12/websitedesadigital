<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformasiDesaResource\Pages;
use App\Models\InformasiDesa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InformasiDesaResource extends Resource
{
    protected static ?string $model = InformasiDesa::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 2;
    protected static ?string $modelLabel = 'Informasi Desa';
    protected static ?string $pluralModelLabel = 'Informasi Desa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Desa')
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->label('Judul Informasi')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('isi')
                            ->label('Isi Informasi')
                            ->required()
                            ->rows(6)
                            ->columnSpanFull(),
                        Forms\Components\Select::make('kategori')
                            ->label('Kategori')
                            ->options([
                                'Umum' => 'Umum',
                                'Pengumuman' => 'Pengumuman',
                                'Kegiatan' => 'Kegiatan',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->required(),
                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->required()
                            ->default(now()),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Umum' => 'gray',
                        'Pengumuman' => 'blue',
                        'Kegiatan' => 'green',
                        'Lainnya' => 'orange',
                    }),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'Umum' => 'Umum',
                        'Pengumuman' => 'Pengumuman',
                        'Kegiatan' => 'Kegiatan',
                        'Lainnya' => 'Lainnya',
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
            ->emptyStateHeading('Belum ada informasi desa')
            ->emptyStateDescription('Klik tombol "Tambah" untuk menambahkan informasi.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInformasiDesas::route('/'),
            'create' => Pages\CreateInformasiDesa::route('/create'),
            'edit' => Pages\EditInformasiDesa::route('/{record}/edit'),
        ];
    }
}