<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contact;
use App\Services\MapService;

class ContactMap extends Component
{
    public $lat;
    public $lng;
    public $address;
    public $email;
    public $phone;

    public function mount(MapService $mapService)
    {
        $contact = Contact::first();
        if ($contact) {
            $this->address = $contact->address;
            $this->email = $contact->email;
            $this->phone = $contact->phone;
            $coords = $mapService->getCoordinatesFromAddress($this->address);
            $this->lat = $coords['lat'] ?? 1.26332;
            $this->lng = $coords['lng'] ?? 101.18264;
        }
        
    }

    public function render()
    {
        return view('livewire.contact-map');
    }
}