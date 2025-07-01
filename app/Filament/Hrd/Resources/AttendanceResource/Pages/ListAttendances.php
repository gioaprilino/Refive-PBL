<?php

namespace App\Filament\Hrd\Resources\AttendanceResource\Pages;

use App\Filament\Hrd\Resources\AttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttendances extends ListRecords
{
    protected static string $resource = AttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            
        ];
    }
}
