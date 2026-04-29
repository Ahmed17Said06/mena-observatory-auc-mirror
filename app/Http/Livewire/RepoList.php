<?php

namespace App\Http\Livewire;

use App\Models\Repo;
use App\Models\Repo_tags;
use App\Models\Repo_type;
use Livewire\Component;
use Livewire\WithPagination;

class RepoList extends Component
{
    use WithPagination;

    public $isOurWork = null;
    public $isGlobal  = null;
    public $filterTag = null;
    public $is_data_repo_page = false;

    public int $perPage = 3;

    // User-driven filters
    public string $search       = '';
    public string $selectedTag  = '';
    public string $selectedYear = '';
    public string $selectedType = '';

    protected $paginationTheme = 'bootstrap';

    // Reset all named paginators when filters change
    private function resetAllPages(): void
    {
        foreach (['research', 'talks', 'educational', 'regional', 'global'] as $name) {
            $this->resetPage($name);
        }
    }

    public function updatingSearch(): void    { $this->resetAllPages(); }
    public function updatedSelectedTag(): void  { $this->resetAllPages(); }
    public function updatedSelectedYear(): void { $this->resetAllPages(); }
    public function updatedSelectedType(): void { $this->resetAllPages(); }

    public function clearFilters(): void
    {
        $this->search       = '';
        $this->selectedTag  = '';
        $this->selectedYear = '';
        $this->selectedType = '';
        $this->resetAllPages();
    }

    public function render()
    {
        $showObservatory = $showRegional = $showGlobal = false;

        if ($this->isOurWork === true) {
            $showObservatory = true;
        } elseif ($this->isOurWork === false && $this->isGlobal === true) {
            $showGlobal = true;
        } elseif ($this->isOurWork === false) {
            $showRegional = true;
        } else {
            $showObservatory = $showRegional = $showGlobal = true;
        }

        $base = Repo::query()
            // Fixed parent-supplied scope (e.g. fow, Gender pages)
            ->when($this->filterTag, fn($q) => $q->whereHas('tags', fn($tq) => $tq->where('name', $this->filterTag)))
            // User search
            ->when($this->search, fn($q) => $q->where(fn($qq) => $qq
                ->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')))
            // User tag filter
            ->when($this->selectedTag, fn($q) => $q->whereHas('tags', fn($tq) => $tq->where('id', $this->selectedTag)))
            // User year filter
            ->when($this->selectedYear, fn($q) => $q->whereYear('publish_date', $this->selectedYear))
            // User type filter
            ->when($this->selectedType, fn($q) => $q->where('repo_type_id', $this->selectedType))
            ->with('tags')
            ->latest();

        $observatoryResearch = $observatoryTalks = $observatoryEducational = null;
        $regionalRepos = $globalRepos = null;

        if ($showObservatory) {
            $obs = (clone $base)->where('is_our_work', true);
            $observatoryResearch = (clone $obs)
                ->where(fn($q) => $q->where('is_research', true)
                    ->orWhere(fn($qq) => $qq->where('is_research', false)
                        ->where('is_talk_webinar', false)
                        ->where('is_educational', false)))
                ->paginate($this->perPage, ['*'], 'research');

            $observatoryTalks = (clone $obs)
                ->where('is_talk_webinar', true)
                ->paginate($this->perPage, ['*'], 'talks');

            $observatoryEducational = (clone $obs)
                ->where('is_educational', true)
                ->paginate($this->perPage, ['*'], 'educational');
        }

        if ($showRegional) {
            $regionalRepos = (clone $base)
                ->where(fn($q) => $q->where('is_our_work', false)->orWhereNull('is_our_work'))
                ->where(fn($q) => $q->where('is_global', false)->orWhereNull('is_global'))
                ->paginate($this->perPage, ['*'], 'regional');
        }

        if ($showGlobal) {
            $globalRepos = (clone $base)
                ->where('is_our_work', false)
                ->where('is_global', true)
                ->paginate($this->perPage, ['*'], 'global');
        }

        // Filter options
        $availableTags = Repo_tags::orderBy('name')->get();

        $availableYears = Repo::whereNotNull('publish_date')
            ->pluck('publish_date')
            ->map(fn($d) => \Carbon\Carbon::parse($d)->year)
            ->unique()
            ->sortDesc()
            ->values();

        $availableTypes = Repo_type::orderBy('name')->get();

        $hasActiveFilters = $this->search || $this->selectedTag || $this->selectedYear || $this->selectedType;

        return view('livewire.repo-list', [
            'showObservatory'        => $showObservatory,
            'showRegional'           => $showRegional,
            'showGlobal'             => $showGlobal,
            'observatoryResearch'    => $observatoryResearch,
            'observatoryTalks'       => $observatoryTalks,
            'observatoryEducational' => $observatoryEducational,
            'regionalRepos'          => $regionalRepos,
            'globalRepos'            => $globalRepos,
            'availableTags'          => $availableTags,
            'availableYears'         => $availableYears,
            'availableTypes'         => $availableTypes,
            'hasActiveFilters'       => $hasActiveFilters,
        ]);
    }
}
