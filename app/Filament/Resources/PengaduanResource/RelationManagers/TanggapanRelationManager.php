<?php

namespace App\Filament\Resources\PengaduanResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TanggapanRelationManager extends RelationManager
{
    protected static string $relationship = 'tanggapan';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_user')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Textarea::make('isi_tanggapan')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('tanggal')
                    ->required()
                    ->default(now()),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('isi_tanggapan')->limit(50),
                Tables\Columns\TextColumn::make('tanggal')->date(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}