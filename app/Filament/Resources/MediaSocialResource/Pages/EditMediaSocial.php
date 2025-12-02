<?php

namespace App\Filament\Resources\MediaSocialResource\Pages;

use App\Filament\Resources\MediaSocialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaSocial extends EditRecord
{
    protected static string $resource = MediaSocialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
