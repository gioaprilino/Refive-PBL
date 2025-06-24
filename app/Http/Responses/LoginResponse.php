<?php

namespace App\Http\Responses;

use App\Filament\Hrd\Resources\EmployeeResource;
use App\Filament\Resources\ContactMessageResource;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        $user = $request->user();
        $currentPanel = Filament::getCurrentPanel()->getId();

    // Jika admin login di panel hrd, redirect ke panel admin
    if ($user->role === 'admin' && $currentPanel === 'hrd') {
        return redirect()->to(ContactMessageResource::getUrl('index', panel: 'admin'));
    }

    // Jika hrd login di panel admin, redirect ke panel hrd
    if ($user->role === 'hrd' && $currentPanel === 'admin') {
        return redirect()->to(DepartmentResource::getUrl('index', panel: 'hrd'));
    }

    // Jika role dan panel sudah sesuai, redirect seperti biasa
    if ($user->role === 'admin') {
        return redirect()->to(ContactMessageResource::getUrl('index'));
    }

    if ($user->role === 'hrd') {
        return redirect()->to(EmployeeResource::getUrl('index'));
    }

        return parent::toResponse($request);
    }
}
