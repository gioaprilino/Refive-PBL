<?php

namespace App\Livewire;

use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $name;

    public $email;

    public $subject;

    public $message;

    public function submit()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required|min:5',
        ]);

        $contact = ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        Mail::to('gioaprilino91@gmail.com')->send(new ContactMessageMail($contact));

        session()->flash('success', 'Your message has been sent. Thank you!');
        $this->reset(); // reset input fields
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
