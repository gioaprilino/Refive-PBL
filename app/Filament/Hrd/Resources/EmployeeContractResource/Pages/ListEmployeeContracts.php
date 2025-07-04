<?php

namespace App\Filament\Hrd\Resources\EmployeeContractResource\Pages;

use App\Filament\Hrd\Resources\EmployeeContractResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmployeeContracts extends ListRecords
{
    protected static string $resource = EmployeeContractResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
