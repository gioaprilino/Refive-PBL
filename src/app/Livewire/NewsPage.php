<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;

class NewsPage extends Component
{
    public function render()
    {
        return view('livewire.news-page', [
            'newsList' => News::latest()->paginate(6),
        ]);
    }
}
