<?php

namespace App\Http\Livewire;

use App\Models\Repo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CountryRepoList extends Component
{
    public Collection $repos;
    public $country_id;
    
    // Lazy loading properties
    public $pageNumber = 1;
    public $perPage = 6;
    public $hasMorePages = true;

    public function mount($country_id)
    {
        $this->country_id = $country_id;
        $this->repos = new Collection();
        $this->loadMore();
    }
    
    private function getQuery()
    {
        return Repo::query()
            ->where('country_id', $this->country_id)
            ->with('tags')
            ->latest();
    }
    
    public function loadMore(): void
    {
        $paginated = $this->getQuery()->paginate($this->perPage, ['*'], 'page', $this->pageNumber);
        
        $this->pageNumber++;
        $this->hasMorePages = $paginated->hasMorePages();
        
        $this->repos = $this->repos->merge($paginated->items());
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.country-repo-list');
    }
}