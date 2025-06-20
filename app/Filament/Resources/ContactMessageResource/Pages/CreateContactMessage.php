<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateContactMessage extends CreateRecord
{
    protected static string $resource = ContactMessageResource::class;
}
