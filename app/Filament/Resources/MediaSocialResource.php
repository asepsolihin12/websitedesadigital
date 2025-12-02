<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaSocialResource\Pages;
use App\Models\MediaSocial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MediaSocialResource extends Resource
{
    protected static ?string $model = MediaSocial::class;

    protected static ?string $navigationIcon = 'heroicon-o-share';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 6;
    protected static ?string $modelLabel = 'Media Sosial';
    protected static ?string $pluralModelLabel = 'Media Sosial';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Section::make('Informasi Media Sosial')
                ->schema([
                    Forms\Components\Select::make('platform')
                        ->label('Platform')
                        ->options([
                            'Facebook' => 'Facebook',
                            'Instagram' => 'Instagram', 
                            'Twitter' => 'Twitter',
                            'YouTube' => 'YouTube',
                            'TikTok' => 'TikTok',
                            'WhatsApp' => 'WhatsApp',
                            'Telegram' => 'Telegram',
                            'LinkedIn' => 'LinkedIn',
                        ])
                        ->required()
                        ->live()
                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                            // Auto-fill icon berdasarkan platform
                            $iconMap = [
                                'Facebook' => 'facebook',
                                'Instagram' => 'instagram',
                                'Twitter' => 'twitter', 
                                'YouTube' => 'youtube',
                                'TikTok' => 'tiktok',
                                'WhatsApp' => 'whatsapp',
                                'Telegram' => 'telegram',
                                'LinkedIn' => 'linkedin',
                            ];
                            
                            if (isset($iconMap[$state])) {
                                $set('icon', $iconMap[$state]);
                            }
                        }),
                    
                    Forms\Components\TextInput::make('url')
                        ->label('URL')
                        ->url()
                        ->required()
                        ->maxLength(255)
                        ->placeholder('https://'),
                    
                    Forms\Components\TextInput::make('icon')
                        ->label('Icon')
                        ->required()
                        ->maxLength(255)
                        ->helperText('Akan terisi otomatis berdasarkan platform'),
                    
                    Forms\Components\TextInput::make('order')
                        ->label('Urutan')
                        ->numeric()
                        ->default(0),
                    
                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true),
                ]),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('platform')
                    ->label('Platform')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->searchable()
                    ->limit(30)
                    ->tooltip(fn($record) => $record->url),
                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('platform')
                    ->label('Platform')
                    ->options([
                        'Facebook' => 'Facebook',
                        'Instagram' => 'Instagram',
                        'Twitter' => 'Twitter',
                        'YouTube' => 'YouTube',
                        'TikTok' => 'TikTok',
                        'WhatsApp' => 'WhatsApp',
                        'Telegram' => 'Telegram',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif')
                    ->boolean()
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif')
                    ->native(false),
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
            ->emptyStateHeading('Belum ada media sosial')
            ->emptyStateDescription('Klik tombol "Tambah" untuk menambahkan media sosial.')
            ->defaultSort('order', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMediaSocials::route('/'),
            'create' => Pages\CreateMediaSocial::route('/create'),
            'edit' => Pages\EditMediaSocial::route('/{record}/edit'),
        ];
    }
}