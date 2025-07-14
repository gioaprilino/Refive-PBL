<?php

namespace App\Filament\Hrd\Resources\EmployeeProjectResource\Pages;

use App\Filament\Hrd\Resources\EmployeeProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployeeProject extends EditRecord
{
    protected static string $resource = EmployeeProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
