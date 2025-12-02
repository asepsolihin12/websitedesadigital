<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TanggapanResource\Pages;
use App\Models\Tanggapan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TanggapanResource extends Resource
{
    protected static ?string $model = Tanggapan::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?string $navigationGroup = 'Layanan Masyarakat';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'Tanggapan';
    protected static ?string $pluralModelLabel = 'Tanggapan Pengaduan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Tanggapan')
                    ->schema([
                        Forms\Components\Select::make('id_pengaduan')
                            ->relationship('pengaduan', 'judul')
                            ->label('Pengaduan')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('id_user')
                            ->relationship('user', 'name')
                            ->label('Petugas')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal Tanggapan')
                            ->required()
                            ->default(now()),
                    ]),
                
                Forms\Components\Section::make('Isi Tanggapan')
                    ->schema([
                        Forms\Components\Textarea::make('isi_tanggapan')
                            ->label('Tanggapan')
                            ->required()
                            ->rows(6)
                            ->columnSpanFull()
                            ->placeholder('Tulis tanggapan untuk pengaduan ini...'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pengaduan.judul')
                    ->label('Pengaduan')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Petugas')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('isi_tanggapan')
                    ->label('Tanggapan')
                    ->limit(50)
                    ->wrap(),
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
                Tables\Filters\SelectFilter::make('pengaduan')
                    ->relationship('pengaduan', 'judul'),
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
            ->emptyStateHeading('Belum ada tanggapan')
            ->emptyStateDescription('Tanggapan untuk pengaduan akan muncul di sini.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTanggapans::route('/'),
            'create' => Pages\CreateTanggapan::route('/create'),
            'edit' => Pages\EditTanggapan::route('/{record}/edit'),
        ];
    }
}