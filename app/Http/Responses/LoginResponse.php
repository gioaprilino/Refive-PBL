<?php

namespace App\Http\Responses;

use App\Filament\Hrd\Resources\EmployeeResource;
use App\Filament\Resources\ContactMessageResource;
use App\Filament\Staff\Resources\ScheduleResource;
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

        // Jika admin login di panel staff, redirect ke panel staff
        if ($user->role === 'admin' && $currentPanel === 'staff') {
            return redirect()->to(ScheduleResource::getUrl('index', panel: 'staff'));
        }

        // Jika hrd login di panel admin, redirect ke panel hrd
        if ($user->role === 'hrd' && $currentPanel === 'admin') {
            return redirect()->to(EmployeeResource::getUrl('index', panel: 'hrd'));
        }

        // Jika hrd login di panel staff, redirect ke panel staff
        if ($user->role === 'hrd' && $currentPanel === 'staff') {
            return redirect()->to(ScheduleResource::getUrl('index', panel: 'staff'));
        }

        // Jika staff login di panel admin atau hrd, redirect ke panel staff
        if ($user->role === 'staff' && in_array($currentPanel, ['admin', 'hrd'])) {
            return redirect()->to(ScheduleResource::getUrl('index', panel: 'staff'));
        }

        // Jika role dan panel sudah sesuai, redirect seperti biasa
        if ($user->role === 'admin') {
            return redirect()->to(ContactMessageResource::getUrl('index'));
        }

        if ($user->role === 'hrd') {
            return redirect()->to(EmployeeResource::getUrl('index'));
        }

        if ($user->role === 'staff') {
            return redirect()->to(ScheduleResource::getUrl('index'));
        }

        return parent::toResponse($request);
    }
}
