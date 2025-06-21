<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Resources\Pages\Page;

class Messages extends Page
{
    protected static string $resource = ContactMessageResource::class;

    protected static string $view = 'filament.resources.contact-message-resource.pages.messages';
}
