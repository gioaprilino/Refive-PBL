<?php

namespace App\Filament\Hrd\Resources\EmployeeResource\Pages;

use App\Filament\Hrd\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $data = $this->form->getState();

        // Pastikan employee punya user_id
        if ($this->record->user_id) {
            $user = User::find($this->record->user_id);
            if ($user) {
                $user->name = $data['name'];
                $user->email = $data['email'];
                if (!empty($data['password'])) {
                    $user->password = bcrypt($data['password']);
                }
                $user->save();
            }
        }
    }
}
