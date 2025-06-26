<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Member;
use App\Models\Service;
use Livewire\Component;

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
