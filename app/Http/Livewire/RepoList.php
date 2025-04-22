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
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RepoList extends Component
{
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

    public function mount()
    {
        // Only load repo types 1 (RESEARCH OUTPUTS) and 2 (EDUCATIONAL RESOURCES)
        // Exclude type 3 (DATA DEPOSITORY) for the Knowledge Hub page
        if (request()->route()->getName() === 'data_repo') {
            // For Data Depository page, only get type 3
            $this->repo_types = Repo_type::where('id', 3)->get();
            $this->is_data_repo_page = true;
            $this->repo_type_ids = [3]; // Pre-select Data Depository (ID 3)
        } else {
            // For Knowledge Hub page, exclude type 3 (DATA DEPOSITORY)
            $this->repo_types = Repo_type::whereNotIn('id', [3])->get();
            // Default to RESEARCH OUTPUTS (ID 1)
            $this->repo_type_ids = [1];
        }
        
        $this->authors = Author::all();
        $this->fields = Repo::whereNotNull('field')->pluck('field')->unique()->toArray();
        $this->subjects = Repo::whereNotNull('subject')->pluck('subject')->unique()->toArray();
        $this->projects = Repo::whereNotNull('project')->pluck('project')->unique()->toArray();
        $this->allCountries = countries::whereExists(function ($query) {
            $query->select()
                ->from('repo')
                ->whereColumn('countries.id', 'repo.country_id');
        })->get();
        $this->publish_dates = Repo::whereNotNull('publish_date')
            ->pluck('publish_date')
            ->map(function ($date) {
                return Carbon::parse($date)->format('Y');
            })
            ->unique()
            ->toArray();
    }

    public function setType($typeName): void
    {
        $this->repo_type_ids = [];
        $this->repo_type_ids[] = $typeName;
    }

    public function clearSearch(): void
    {
        $this->search = '';
        $this->filterUpdated();
    }

    public function render(): View|Factory|Application
    {
        $repos = Repo::query()
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
            ->with('tags')
            ->take(6)
            ->latest()
            ->get();

        return view('livewire.repo-list', ['repos' => $repos]);
    }

    public function filterUpdated()
    {
        $this->render();
    }

    public function clear()
    {
        $this->reset('repo_type_ids', 'search', 'selectedAuthorsIds',
            'selectedFields', 'selectedSubjects', 'selectedProjects', 'selectedPublishDates', 'selectedCountryIds');
    }
}
