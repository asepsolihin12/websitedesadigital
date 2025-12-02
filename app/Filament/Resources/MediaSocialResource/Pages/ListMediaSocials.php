<?php

namespace App\Filament\Resources\MediaSocialResource\Pages;

use App\Filament\Resources\MediaSocialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaSocials extends ListRecords
{
    protected static string $resource = MediaSocialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
