<?php

namespace App\Filament\Hrd\Resources\EmployeeProjectResource\Pages;

use App\Filament\Hrd\Resources\EmployeeProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmployeeProjects extends ListRecords
{
    protected static string $resource = EmployeeProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
