<?php

namespace App\Http\Livewire;

use App\Models\GenderAi;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class GenderaiPage extends Component
{
    public Collection $gender_ai;
    
    // Lazy loading properties
    public $pageNumber = 1;
    public $perPage = 3;
    public $hasMorePages = true;

    public function mount()
    {
        $this->gender_ai = new Collection();
        $this->loadMore();
    }
    
    private function getQuery()
    {
        return GenderAi::latest();
    }
    
    public function loadMore(): void
    {
        $paginated = $this->getQuery()->paginate($this->perPage, ['*'], 'page', $this->pageNumber);
        
        $this->pageNumber++;
        $this->hasMorePages = $paginated->hasMorePages();
        
        $this->gender_ai = $this->gender_ai->merge($paginated->items());
    }

    public function render()
    {
        return view('livewire.genderai-page');
    }
}