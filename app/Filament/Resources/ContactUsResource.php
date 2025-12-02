<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactUsResource\Pages;
use App\Models\ContactUs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactUsResource extends Resource
{
    protected static ?string $model = ContactUs::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Layanan Masyarakat';
    protected static ?int $navigationSort = 4;
    protected static ?string $modelLabel = 'Pesan Masuk';
    protected static ?string $pluralModelLabel = 'Pesan Masuk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengirim')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Lengkap')
                            ->disabled(),
                        Forms\Components\TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->disabled(),
                    ])->columns(2),
                
                Forms\Components\Section::make('Isi Pesan')
                    ->schema([
                        Forms\Components\Textarea::make('pesan')
                            ->label('Pesan')
                            ->disabled()
                            ->rows(6)
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->disabled(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pesan')
                    ->label('Pesan')
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
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada pesan masuk')
            ->emptyStateDescription('Pesan dari pengunjung akan muncul di sini.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactUs::route('/'),
        ];
    }
}