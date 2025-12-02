<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendudukResource\Pages;
use App\Models\Penduduk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PendudukResource extends Resource
{
    protected static ?string $model = Penduduk::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Data Desa';
    protected static ?int $navigationSort = 2;
    protected static ?string $modelLabel = 'Penduduk';
    protected static ?string $pluralModelLabel = 'Data Penduduk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Akun')
                    ->schema([
                        Forms\Components\Select::make('id_user')
                            ->relationship('user', 'name')
                            ->label('User Terkait')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('Pilih user yang terkait dengan data penduduk ini'),
                    ]),
                
                Forms\Components\Section::make('Data Pribadi')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(16)
                            ->helperText('Nomor Induk Kependudukan 16 digit'),
                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat Lengkap')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),
                
                Forms\Components\Section::make('Data Lahir')
                    ->schema([
                        Forms\Components\Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('tgl_lahir')
                            ->label('Tanggal Lahir')
                            ->required()
                            ->maxDate(now()),
                    ])->columns(3),
                
                Forms\Components\Section::make('Data Tambahan')
                    ->schema([
                        Forms\Components\TextInput::make('agama')
                            ->label('Agama')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('pekerjaan')
                            ->label('Pekerjaan')
                            ->maxLength(255),
                        Forms\Components\Select::make('status_perkawinan')
                            ->label('Status Perkawinan')
                            ->options([
                                'Belum Menikah' => 'Belum Menikah',
                                'Menikah' => 'Menikah',
                                'Cerai Hidup' => 'Cerai Hidup',
                                'Cerai Mati' => 'Cerai Mati',
                            ]),
                        Forms\Components\TextInput::make('pendidikan_terakhir')
                            ->label('Pendidikan Terakhir')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('no_telepon')
                            ->label('No. Telepon')
                            ->tel()
                            ->maxLength(15),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_penduduk')
                    ->label('ID')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama User')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Penduduk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('JK')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Laki-laki' => 'blue',
                        'Perempuan' => 'pink',
                    }),
                Tables\Columns\TextColumn::make('tempat_lahir')
                    ->label('Tempat Lahir')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tgl_lahir')
                    ->label('Tgl Lahir')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('agama')
                    ->label('Agama')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ]),
                Tables\Filters\SelectFilter::make('agama')
                    ->label('Agama')
                    ->options([
                        'Islam' => 'Islam',
                        'Kristen' => 'Kristen',
                        'Katolik' => 'Katolik',
                        'Hindu' => 'Hindu',
                        'Buddha' => 'Buddha',
                        'Konghucu' => 'Konghucu',
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenduduks::route('/'),
            'create' => Pages\CreatePenduduk::route('/create'),
            'view' => Pages\ViewPenduduk::route('/{record}'),
            'edit' => Pages\EditPenduduk::route('/{record}/edit'),
        ];
    }
}