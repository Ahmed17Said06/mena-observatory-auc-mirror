<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\NewWorkBlog;
use Illuminate\Database\Eloquent\Collection;

class NewWorkBlogs extends Component
{
    public Collection $newWorkBlogs;
    
    // Lazy loading properties
    public $pageNumber = 1;
    public $perPage = 3;
    public $hasMorePages = true;

    public function mount()
    {
        $this->newWorkBlogs = new Collection();
        $this->loadMore();
    }
    
    private function getQuery()
    {
        return NewWorkBlog::published()
            ->orderBy('publish_date', 'desc');
    }
    
    public function loadMore(): void
    {
        $paginated = $this->getQuery()->paginate($this->perPage, ['*'], 'page', $this->pageNumber);
        
        $this->pageNumber++;
        $this->hasMorePages = $paginated->hasMorePages();
        
        $this->newWorkBlogs = $this->newWorkBlogs->merge($paginated->items());
    }
    
    private function resetItems(): void
    {
        $this->newWorkBlogs = new Collection();
        $this->pageNumber = 1;
        $this->hasMorePages = true;
        $this->loadMore();
    }

    public function render()
    {
        return view('livewire.new-work-blogs');
    }
}