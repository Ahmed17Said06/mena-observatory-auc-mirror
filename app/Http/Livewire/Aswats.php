<?php

namespace App\Http\Livewire;

use App\Models\Aswat;
use Livewire\Component;

class Aswats extends Component
{
    public $search = '';

    // Lazy loading properties
    public $pageNumber = 1;
    public $perPage = 3;
    public $hasMorePages = true;

    public function updatedSearch(): void
    {
        // Reset paging whenever the search term changes so results start fresh.
        $this->pageNumber = 1;
    }

    private function getQuery()
    {
        $term = trim($this->search);

        return Aswat::query()
            ->when($term !== '', function ($q) use ($term) {
                $q->where(function ($sub) use ($term) {
                    $sub->where('title', 'like', '%' . $term . '%')
                        ->orWhere('description', 'like', '%' . $term . '%');
                });
            })
            ->latest();
    }

    public function loadMore(): void
    {
        $this->pageNumber++;
    }

    public function render()
    {
        // Rebuild the visible list from scalar state each render so we never
        // persist (and serialize) model objects across Livewire requests.
        $total     = $this->perPage * $this->pageNumber;
        $paginated = $this->getQuery()->paginate($total, ['*'], 'page', 1);

        $this->hasMorePages = $paginated->hasMorePages();

        return view('livewire.aswats', ['aswats' => collect($paginated->items())]);
    }
}
