<?php

namespace App\Filament\Resources\SuratOnlineResource\Pages;

use App\Filament\Resources\SuratOnlineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuratOnlines extends ListRecords
{
    protected static string $resource = SuratOnlineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
