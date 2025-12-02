<?php

namespace App\Filament\Resources\TenagaKerjaResource\Pages;

use App\Filament\Resources\TenagaKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTenagaKerja extends EditRecord
{
    protected static string $resource = TenagaKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
