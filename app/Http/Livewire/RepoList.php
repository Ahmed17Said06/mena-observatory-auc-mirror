<?php

namespace App\Http\Livewire;

use App\Models\Author;
use App\Models\countries;
use App\Models\Repo;
use App\Models\Repo_tags;
use App\Models\Repo_theme;
use App\Models\Repo_type;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection as BaseCollection; // Alias Illuminate\Support\Collection
use Illuminate\Database\Eloquent\Collection; // Use Illuminate\Database\Eloquent\Collection directly
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RepoList extends Component
{
    public Collection $repos; // Now refers to Illuminate\Database\Eloquent\Collection
    public $repo_type_ids = [];
    public $search = '';
    public $authors = [];
    public $selectedAuthorsIds = [];

    public $fields = [];
    public $selectedFields = [];

    public $subjects = [];
    public $selectedSubjects = [];

    public $projects = [];
    public $selectedProjects = [];

    public $publish_dates = [];
    public $selectedPublishDates = [];

    public $allCountries = [];
    public $selectedCountryIds = [];

    public $is_data_repo_page = false;
    public $isOurWork = null;
    public $isGlobal = null;
    public $filterTag = null;
    
    // Lazy loading properties
    public $pageNumber = 1;
    public $perPage = 6;
    public $hasMorePages = true;

    public function mount()
    {
        $this->repos = new Collection();

        // Load all repo types including Data Depository
        $this->repo_types = Repo_type::All();
        // Default to RESEARCH OUTPUTS (ID 1) unless a tag filter is active (show all types)
        $this->repo_type_ids = $this->filterTag ? [] : [1];

        // Scope filter options to the current page context (isOurWork / isGlobal)
        $base = Repo::query()
            ->when(!is_null($this->isOurWork), fn($q) => $q->where('is_our_work', $this->isOurWork))
            ->when(!is_null($this->isGlobal),  fn($q) => $q->where('is_global',   $this->isGlobal))
            ->when($this->filterTag, fn($q) => $q->whereHas('tags', fn($tq) => $tq->where('name', $this->filterTag)));

        $this->authors = Author::whereHas('repos', function ($q) use ($base) {
            $q->when(!is_null($this->isOurWork), fn($q) => $q->where('is_our_work', $this->isOurWork))
              ->when(!is_null($this->isGlobal),  fn($q) => $q->where('is_global',   $this->isGlobal));
        })->get();

        $this->fields = (clone $base)->whereNotNull('field')->pluck('field')->unique()->values()->toArray();
        $this->subjects = (clone $base)->whereNotNull('subject')->pluck('subject')->unique()->values()->toArray();
        $this->projects = (clone $base)->whereNotNull('project')->pluck('project')->unique()->values()->toArray();

        $contextRepoIds = (clone $base)->pluck('id');
        $this->allCountries = countries::whereExists(function ($query) use ($contextRepoIds) {
            $query->select()
                ->from('repo')
                ->whereColumn('countries.id', 'repo.country_id')
                ->whereIn('repo.id', $contextRepoIds);
        })->get();

        $this->publish_dates = (clone $base)->whereNotNull('publish_date')
            ->pluck('publish_date')
            ->map(fn($date) => Carbon::parse($date)->format('Y'))
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        // Initial load
        $this->loadMore();
    }

    public function setType($typeName): void
    {
        $this->repo_type_ids = [];
        $this->repo_type_ids[] = $typeName;
        $this->resetItems();
    }

    public function clearSearch(): void
    {
        $this->search = '';
        $this->resetItems();
    }
    
    private function getQuery()
    {
        return Repo::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when(count($this->repo_type_ids), function ($query) {
                $query->whereIn('repo_type_id', $this->repo_type_ids);
            })
            ->when(count($this->selectedAuthorsIds), function ($query) {
                $query->whereHas('authors', function ($authorQuery) {
                    $authorQuery->whereIn('author_id', $this->selectedAuthorsIds);
                });
            })
            ->when(count($this->selectedFields), function ($query) {
                $query->whereIn('field', $this->selectedFields);
            })
            ->when(count($this->selectedSubjects), function ($query) {
                $query->whereIn('subject', $this->selectedSubjects);
            })
            ->when(count($this->selectedProjects), function ($query) {
                $query->whereIn('project', $this->selectedProjects);
            })
            ->when(count($this->selectedPublishDates), function ($query) {
                $query->whereIn(DB::raw('YEAR(publish_date)'), $this->selectedPublishDates);
            })
            ->when(count($this->selectedCountryIds), function ($query) {
                $query->whereIn('country_id', $this->selectedCountryIds);
            })
            ->when(!is_null($this->isOurWork), function ($query) {
                $query->where('is_our_work', $this->isOurWork);
            })
            ->when(!is_null($this->isGlobal), function ($query) {
                $query->where('is_global', $this->isGlobal);
            })
            ->when($this->filterTag, fn($query) => $query->whereHas('tags', fn($tq) => $tq->where('name', $this->filterTag)))
            ->with('tags')
            ->latest();
    }
    
    public function loadMore(): void
    {
        $paginated = $this->getQuery()->paginate($this->perPage, ['*'], 'page', $this->pageNumber);
        
        $this->pageNumber++;
        $this->hasMorePages = $paginated->hasMorePages();
        
        // Append new items to the collection
        $this->repos = $this->repos->merge($paginated->items());
    }
    
    private function resetItems(): void
    {
        $this->repos = new Collection();
        $this->pageNumber = 1;
        $this->hasMorePages = true;
        $this->loadMore();
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.repo-list');
    }

    public function filterUpdated()
    {
        $this->resetItems();
    }

    public function clear()
    {
        $this->reset('repo_type_ids', 'search', 'selectedAuthorsIds',
            'selectedFields', 'selectedSubjects', 'selectedProjects', 'selectedPublishDates', 'selectedCountryIds');

        // Re-set default type: all types when tag-filtered, otherwise RESEARCH OUTPUTS (ID 1)
        $this->repo_type_ids = $this->filterTag ? [] : [1];
        
        $this->resetItems();
    }

    public function updatingSearch()
    {
        $this->resetItems();
    }

    public function updatingSelectedAuthorsIds()
    {
        $this->resetItems();
    }

    public function updatingSelectedFields()
    {
        $this->resetItems();
    }

    public function updatingSelectedSubjects()
    {
        $this->resetItems();
    }

    public function updatingSelectedProjects()
    {
        $this->resetItems();
    }

    public function updatingSelectedPublishDates()
    {
        $this->resetItems();
    }

    public function updatingSelectedCountryIds()
    {
        $this->resetItems();
    }
}
