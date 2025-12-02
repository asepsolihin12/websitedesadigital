<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaduanResource\Pages;
use App\Models\Pengaduan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PengaduanResource extends Resource
{
    protected static ?string $model = Pengaduan::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';
    protected static ?string $navigationGroup = 'Layanan Masyarakat';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Pengaduan';
    protected static ?string $pluralModelLabel = 'Pengaduan Masyarakat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengaduan')
                    ->schema([
                        Forms\Components\Select::make('id_user')
                            ->relationship('user', 'name')
                            ->label('Pelapor')
                            ->disabled(),
                        Forms\Components\TextInput::make('judul')
                            ->label('Judul Pengaduan')
                            ->disabled(),
                        Forms\Components\Textarea::make('isi')
                            ->label('Isi Pengaduan')
                            ->disabled()
                            ->rows(6)
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->disabled(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'Menunggu' => 'Menunggu',
                                'Diproses' => 'Diproses',
                                'Selesai' => 'Selesai',
                            ])
                            ->required()
                            ->default('Menunggu'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pelapor')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Menunggu' => 'gray',
                        'Diproses' => 'warning',
                        'Selesai' => 'success',
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
                        'Diproses' => 'Diproses',
                        'Selesai' => 'Selesai',
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
            ->emptyStateHeading('Belum ada pengaduan')
            ->emptyStateDescription('Pengaduan dari masyarakat akan muncul di sini.');
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\PengaduanResource\RelationManagers\TanggapanRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengaduans::route('/'),
            'edit' => Pages\EditPengaduan::route('/{record}/edit'),
        ];
    }
}