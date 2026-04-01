<?php

namespace App\Http\Livewire;

use App\Models\Aswat;
use App\Models\Partner;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Aswats extends Component
{
    public Collection $aswats;
    
    // Lazy loading properties
    public $pageNumber = 1;
    public $perPage = 3;
    public $hasMorePages = true;

    public function mount()
    {
        $this->aswats = new Collection();
        $this->loadMore();
    }
    
    private function getQuery()
    {
        return Aswat::latest();
    }
    
    public function loadMore(): void
    {
        $paginated = $this->getQuery()->paginate($this->perPage, ['*'], 'page', $this->pageNumber);
        
        $this->pageNumber++;
        $this->hasMorePages = $paginated->hasMorePages();
        
        $this->aswats = $this->aswats->merge($paginated->items());
    }

    public function render()
    {
        return view('livewire.aswats');
    }
}