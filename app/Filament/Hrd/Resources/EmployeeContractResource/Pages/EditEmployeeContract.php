<?php

namespace App\Filament\Hrd\Resources\EmployeeContractResource\Pages;

use App\Filament\Hrd\Resources\EmployeeContractResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployeeContract extends EditRecord
{
    protected static string $resource = EmployeeContractResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
