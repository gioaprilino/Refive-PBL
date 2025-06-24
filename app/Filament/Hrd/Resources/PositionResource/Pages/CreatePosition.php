<?php

namespace App\Filament\Hrd\Resources\PositionResource\Pages;

use App\Filament\Hrd\Resources\PositionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePosition extends CreateRecord
{
    protected static string $resource = PositionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
