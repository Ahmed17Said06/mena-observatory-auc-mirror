<?php

namespace App\Http\Livewire;

use App\Models\FeaturedPost;
use App\Models\static_content;
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
        $keys = [
            'featured_safe_ai_title', 'featured_safe_ai_desc',
            'featured_rai_cup_title', 'featured_rai_cup_subtitle',
            'featured_girai_title', 'featured_girai_desc',
            'featured_pw_mena_title', 'featured_pw_mena_desc',
            'featured_brochures_title', 'featured_brochures_desc',
        ];
        $sc = static_content::whereIn('key', $keys)->latest()->get()
            ->each(function ($row) {
                $row->content    = strip_tags($row->content ?? '');
                $row->ar_content = strip_tags($row->ar_content ?? '');
            })
            ->keyBy('key');

        return view('livewire.featured-page', ['sc' => $sc]);
    }
}
