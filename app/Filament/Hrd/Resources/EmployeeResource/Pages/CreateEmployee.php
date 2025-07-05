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

    /**
     * Fungsi ini dieksekusi SETELAH data Employee berhasil dibuat.
     * Kita bisa mengakses data Employee yang baru melalui $this->record.
     */
    protected function afterCreate(): void
    {
        // $this->record adalah data Employee yang baru saja dibuat.
        $employee = $this->record;
        $data = $this->form->getState();

        // Buat user baru DAN langsung isikan employee_id
        // dengan ID dari employee yang baru dibuat.
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'email_verified_at' => now(),
            'password' => $data['password'], // Pastikan password sudah di-hash oleh mutator di Model User Anda
            'role' => 'staff',
            'employee_id' => $employee->id, // INI BAGIAN PENTINGNYA
        ]);

        // Sekarang, update employee dengan user_id yang baru dibuat
        // untuk membuat hubungan dua arah.
        $employee->user_id = $user->id;
        $employee->save();
    }
}
