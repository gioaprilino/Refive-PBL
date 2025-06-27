<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\News;

class NewsDetailPage extends Component
{
    public News $news;

    public function mount(News $news)
    {
        $this->news = $news;
    }

    public function render()
    {
        return view('livewire.news-detail-page');
    }
}
