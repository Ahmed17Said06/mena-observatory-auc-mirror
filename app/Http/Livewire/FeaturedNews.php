<?php

namespace App\Http\Livewire;

use App\Models\News;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class FeaturedNews extends Component
{
    public Collection $blogs;
    public $community;
    
    // Lazy loading properties
    public $pageNumber = 1;
    public $perPage = 3;
    public $hasMorePages = true;

    public function mount($community = null)
    {
        $this->community = $community;
        $this->blogs = new Collection();
        $this->loadMore();
    }
    
    private function getQuery()
    {
        if ($this->community) {
            return $this->community->news();
        }
        return News::where('featured', 'yes');
    }
    
    public function loadMore(): void
    {
        $paginated = $this->getQuery()->paginate($this->perPage, ['*'], 'page', $this->pageNumber);
        
        $this->pageNumber++;
        $this->hasMorePages = $paginated->hasMorePages();
        
        $this->blogs = $this->blogs->merge($paginated->items());
    }

    public function render()
    {
        return view('livewire.featured-news');
    }
}