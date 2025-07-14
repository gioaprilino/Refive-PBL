<?php

namespace App\Filament\Staff\Resources\MyProjectResource\Pages;

use App\Filament\Staff\Resources\MyProjectResource;
use Filament\Resources\Pages\ListRecords;

class ListMyProjects extends ListRecords
{
    protected static string $resource = MyProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
