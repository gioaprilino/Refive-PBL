<?php

namespace App\Filament\Staff\Resources\AssetLoanResource\Pages;

use App\Filament\Staff\Resources\AssetLoanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListAssetLoans extends ListRecords
{
    protected static string $resource = AssetLoanResource::class;

    protected function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id());
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

}
