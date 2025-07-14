<?php

namespace App\Filament\Hrd\Resources\ScheduleResource\Pages;

use App\Filament\Hrd\Resources\ScheduleResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListSchedules extends ListRecords
{
    protected static string $resource = ScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('presensi')
                ->url(route('presensi'), shouldOpenInNewTab: true)
                ->color('warning'),
            Actions\CreateAction::make(),
        ];
    }
}
