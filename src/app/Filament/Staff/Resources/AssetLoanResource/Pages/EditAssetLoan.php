<?php

namespace App\Filament\Staff\Resources\AssetLoanResource\Pages;

use App\Filament\Staff\Resources\AssetLoanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetLoan extends EditRecord
{
    protected static string $resource = AssetLoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
