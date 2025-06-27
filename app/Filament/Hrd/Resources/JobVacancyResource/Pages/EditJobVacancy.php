<?php

namespace App\Filament\Hrd\Resources\JobVacancyResource\Pages;

use App\Filament\Hrd\Resources\JobVacancyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJobVacancy extends EditRecord
{
    protected static string $resource = JobVacancyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
