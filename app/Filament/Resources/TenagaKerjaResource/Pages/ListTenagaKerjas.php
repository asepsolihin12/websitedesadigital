<?php

namespace App\Filament\Resources\TenagaKerjaResource\Pages;

use App\Filament\Resources\TenagaKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTenagaKerjas extends ListRecords
{
    protected static string $resource = TenagaKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
