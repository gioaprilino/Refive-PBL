<?php

namespace App\Filament\Hrd\Resources\LeaveRequestResource\Pages;

use App\Filament\Hrd\Resources\LeaveRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLeaveRequest extends ViewRecord
{
    protected static string $resource = LeaveRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
