<?php

namespace App\Filament\Hrd\Resources\AssetLoanResource\Pages;

use App\Filament\Hrd\Resources\AssetLoanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetLoans extends ListRecords
{
    protected static string $resource = AssetLoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
