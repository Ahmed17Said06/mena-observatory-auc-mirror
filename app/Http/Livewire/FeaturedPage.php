<?php

namespace App\Http\Livewire;

use App\Models\FeaturedInitiativeCard;
use App\Models\FeaturedPost;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class FeaturedPage extends Component
{
    public Collection $featuredPosts;
    
    // Lazy loading properties
    public $pageNumber = 1;
    public $perPage = 3;
    public $hasMorePages = true;

    public function mount()
    {
        $this->featuredPosts = new Collection();
        $this->loadMore();
    }
    
    private function getQuery()
    {
        return FeaturedPost::latest();
    }
    
    public function loadMore(): void
    {
        $paginated = $this->getQuery()->paginate($this->perPage, ['*'], 'page', $this->pageNumber);
        
        $this->pageNumber++;
        $this->hasMorePages = $paginated->hasMorePages();
        
        $this->featuredPosts = $this->featuredPosts->merge($paginated->items());
    }

    public function render()
    {
        $initiativeCards = FeaturedInitiativeCard::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('livewire.featured-page', ['initiativeCards' => $initiativeCards]);
    }
}
