<?php

namespace App\Http\Livewire;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class FeaturedNews extends Component
{
    use WithPagination;

    public $community;

    public function mount($community=null)
    {
        $this->community = $community;
    }

    public function render()
    {
        if ($this->community) {
            return view('livewire.featured-news', [
                'blogs' => $this->community->news()->paginate(3),
            ]);
        }
        return view('livewire.featured-news', [
            'blogs' => News::where('featured', 'yes')->paginate(3),
        ]);
    }

    public function paginationView()
    {
        return 'components.frontend.news-pagination';
    }
}
