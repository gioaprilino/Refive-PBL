<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NewsletterForm extends Component
{
    public $email;

    public $successMessage = '';

    public $errorMessage = '';

    protected $rules = [
        'email' => 'required|email',
    ];

    public function submit()
    {
        $this->reset('successMessage', 'errorMessage');
        $this->validate();

        if (DB::table('newsletters')->where('email', $this->email)->exists()) {
            $this->errorMessage = 'Email ini sudah pernah subscribe.';

            return;
        }

        DB::table('newsletters')->insert([
            'email' => $this->email,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->successMessage = 'Berhasil subscribe newsletter. Terima kasih!';
        $this->reset('email');
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
