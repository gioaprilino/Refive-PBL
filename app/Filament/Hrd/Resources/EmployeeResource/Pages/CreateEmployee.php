<?php

namespace App\Filament\Hrd\Resources\EmployeeResource\Pages;

use App\Filament\Hrd\Resources\EmployeeResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $data = $this->form->getState();

        // Buat user baru
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'email_verified_at' => now(),
            'password' => bcrypt($data['password']),
            'role' => 'staff', // atau role sesuai kebutuhan
        ]);

        // Update employee dengan user_id
        $this->record->user_id = $user->id;
        $this->record->save();
    }
}
