<?php

namespace App\Http\Livewire;

use App\Models\Blogs;
use App\Models\countries;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class BlogPosts extends Component
{
    // Store only IDs to avoid Livewire hydration issues with model objects
    public array $blogIds = [];
    public $search = '';
    public $allCountries = [];
    public $selectedCountryId = '';
    public $startDate = '';
    public $endDate = '';
    public $filterApplied = false;
    public $showPopup = false;
    
    // Lazy loading properties
    public $pageNumber = 1;
    public $perPage = 6;
    public $hasMorePages = true;

    public function mount()
    {
        $this->blogIds = [];
        $this->allCountries = countries::whereExists(function ($query) {
            $query->select()
                ->from('blogs')
                ->whereColumn('countries.id', 'blogs.country_id');
        })->get();
        
        // Initial load
        $this->loadMore();
    }

    public function updateSearch()
    {
        $this->resetItems();
    }

    public function applyFilters()
    {
        $this->validate([
            'startDate' => 'date',
            'endDate' => 'date|after:startDate',
        ], [
            'startDate.date' => 'Please enter a valid start date.',
            'endDate.date' => 'Please enter a valid end date.',
            'endDate.after' => 'End date must be after the start date.',
        ]);

        if ($this->showPopup) {
            $this->showPopup = false;
        }
        $this->filterApplied = true;
        $this->resetItems();
    }

    public function clearAllFilters()
    {
        $this->selectedCountryId = '';
        $this->startDate = '';
        $this->endDate = '';
        $this->filterApplied = false;
        $this->showPopup();
        $this->resetItems();
    }

    public function showPopup()
    {
        $this->showPopup = !$this->showPopup;
    }
    
    private function getQuery()
    {
        $query = Blogs::where('title', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc');

        if ($this->filterApplied) {
            $query->when($this->selectedCountryId, function ($query) {
                $query->where('country_id', $this->selectedCountryId);
            })
            ->when($this->startDate && $this->endDate, function ($query) {
                $query->whereBetween('publish_date', [$this->startDate, $this->endDate]);
            });
        }
        
        return $query;
    }
    
    public function loadMore(): void
    {
        $paginated = $this->getQuery()->paginate($this->perPage, ['*'], 'page', $this->pageNumber);
        
        $this->pageNumber++;
        $this->hasMorePages = $paginated->hasMorePages();
        
        // Store only IDs to avoid Livewire hydration issues
        $newIds = collect($paginated->items())->pluck('id')->toArray();
        $this->blogIds = array_merge($this->blogIds, $newIds);
    }
    
    private function resetItems(): void
    {
        $this->blogIds = [];
        $this->pageNumber = 1;
        $this->hasMorePages = true;
        $this->loadMore();
    }

    public function render(): View|Factory|Application
    {
        // Query fresh data using stored IDs - this ensures proper model objects
        $blogs = collect();
        if (!empty($this->blogIds)) {
            $blogs = Blogs::whereIn('id', $this->blogIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $this->blogIds) . ')')
                ->get();
        }
        
        return view('livewire.blog-posts', [
            'blogs' => $blogs
        ]);
    }
}