<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\News;

class NewsPage extends Component
{
    public function render()
    {
        return view('livewire.news-page', [
            'newsList' => News::latest()->paginate(6),
        ]);
    }
}
