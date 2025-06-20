<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use App\Models\Member;
use App\Models\Client;

class ShowHome extends Component
{
    public function render()
    {
        $services = Service::orderBy('title', 'ASC')->get();
        $member = Member::orderBy('name', 'ASC')->get();
        return view('livewire.show-home', [
            'services' => $services,
            'members' => $member,
            'clients' => Client::all(),
        ]);

    }
}
