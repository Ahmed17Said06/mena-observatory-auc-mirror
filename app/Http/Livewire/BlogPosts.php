<?php

namespace App\Http\Livewire;

use App\Models\Blogs;
use App\Models\countries;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class BlogPosts extends Component
{
    use WithPagination;

    public $search = '';
    public $allCountries = [];
    public $selectedCountryId = '';
    public $startDate = '';
    public $endDate = '';
    public $filterApplied = false;
    public $showPopup = false;

    public function updateSearch()
    {
        $this->resetPage();
    }
//    public function updated($propertyName){
//        $this->validateOnly($propertyName,[
//            'selectedCountryId' => 'required',
//            'startDate' => 'required|date',
//            'endDate' => 'required|date|after:startDate',
//        ]);
//        $this->applyFilters();
//    }

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
    }

    public function clearAllFilters()
    {
        $this->selectedCountryId = '';
        $this->startDate = '';
        $this->endDate = '';
        $this->showPopup();
        $this->resetPage();
    }

    public function showPopup()
    {
        $this->showPopup = !$this->showPopup;
    }

    public function mount()
    {
        $this->allCountries = countries::whereExists(function ($query) {
            $query->select()
                ->from('blogs')
                ->whereColumn('countries.id', 'blogs.country_id');
        })->get();
    }


    public function render(): View|Factory|Application
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

        return view('livewire.blog-posts', [
            'blogs' => $query->paginate(6),
        ]);
    }
}
