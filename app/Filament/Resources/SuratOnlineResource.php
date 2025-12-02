<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratOnlineResource\Pages;
use App\Models\SuratOnline;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SuratOnlineResource extends Resource
{
    protected static ?string $model = SuratOnline::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Layanan Masyarakat';
    protected static ?int $navigationSort = 2;
    protected static ?string $modelLabel = 'Surat Online';
    protected static ?string $pluralModelLabel = 'Pengajuan Surat Online';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengajuan')
                    ->schema([
                        Forms\Components\Select::make('id_user')
                            ->relationship('user', 'name')
                            ->label('Pemohon')
                            ->disabled(),
                        Forms\Components\Select::make('jenis_surat')
                            ->label('Jenis Surat')
                            ->disabled()
                            ->options([
                                'Surat Keterangan Domisili' => 'Surat Keterangan Domisili',
                                'Surat Keterangan Tidak Mampu' => 'Surat Keterangan Tidak Mampu',
                                'Surat Keterangan Usaha' => 'Surat Keterangan Usaha',
                                'Surat Keterangan Kelahiran' => 'Surat Keterangan Kelahiran',
                                'Surat Keterangan Kematian' => 'Surat Keterangan Kematian',
                                'Surat Pengantar' => 'Surat Pengantar',
                            ]),
                        Forms\Components\DatePicker::make('tanggal_pengajuan')
                            ->label('Tanggal Pengajuan')
                            ->disabled(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'Menunggu' => 'Menunggu',
                                'Diterima' => 'Diterima',
                                'Ditolak' => 'Ditolak',
                            ])
                            ->required()
                            ->default('Menunggu'),
                    ]),
                
                Forms\Components\Section::make('Keterangan')
                    ->schema([
                        Forms\Components\Textarea::make('keterangan')
                            ->label('Keterangan Tambahan')
                            ->rows(3)
                            ->columnSpanFull()
                            ->placeholder('Keterangan tambahan dari admin...'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pemohon')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_surat')
                    ->label('Jenis Surat')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('tanggal_pengajuan')
                    ->label('Tanggal Pengajuan')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Menunggu' => 'gray',
                        'Diterima' => 'success',
                        'Ditolak' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'Menunggu' => 'Menunggu',
                        'Diterima' => 'Diterima',
                        'Ditolak' => 'Ditolak',
                    ]),
                Tables\Filters\SelectFilter::make('jenis_surat')
                    ->label('Jenis Surat')
                    ->options([
                        'Surat Keterangan Domisili' => 'Surat Keterangan Domisili',
                        'Surat Keterangan Tidak Mampu' => 'Surat Keterangan Tidak Mampu',
                        'Surat Keterangan Usaha' => 'Surat Keterangan Usaha',
                        'Surat Keterangan Kelahiran' => 'Surat Keterangan Kelahiran',
                        'Surat Keterangan Kematian' => 'Surat Keterangan Kematian',
                        'Surat Pengantar' => 'Surat Pengantar',
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
            ->emptyStateHeading('Belum ada pengajuan surat')
            ->emptyStateDescription('Pengajuan surat online akan muncul di sini.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuratOnlines::route('/'),
            'edit' => Pages\EditSuratOnline::route('/{record}/edit'),
        ];
    }
}