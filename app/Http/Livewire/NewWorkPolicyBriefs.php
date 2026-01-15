<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PolicyBrief;
use Illuminate\Support\Collection as BaseCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

// If you have these models, import them; otherwise remove and use distinct() from PolicyBrief
use App\Models\Author;
use App\Models\countries;
use App\Models\Country;
use App\Models\Repo_type;
use App\Models\RepoType; // only if PolicyBriefs have a type; else remove

class NewWorkPolicyBriefs extends Component
{
    public Collection $policyBriefs;
    
    // Lazy loading properties
    public $pageNumber = 1;
    public $perPage = 3;
    public $hasMorePages = true;

    // Search
    public string $search = '';

    // Filter state (names match your Blade wire:model.*)
    public array $selectedAuthorsIds     = [];
    public array $selectedFields         = [];
    public array $selectedSubjects       = [];
    public array $selectedProjects       = [];
    public array $selectedPublishDates   = []; // years
    public array $repo_type_ids          = [];
    public array $selectedCountryIds     = [];

    // Datasets for the sidebar
    public array $authors        = [];
    public array $fields         = [];
    public array $subjects       = [];
    public array $projects       = [];
    public array $publish_dates  = []; // years list
    public array $repo_types     = []; // optional
    public array $allCountries   = [];

    // For showing/hiding the type buttons at the top (like your Knowledge Hub page)
    public bool $is_data_repo_page = false;

    public function mount(): void
    {
        $this->policyBriefs = new Collection();
        
        // ===== Build filter lists =====
        // Authors (if you have an Author model + relation)
        $this->authors = class_exists(Author::class)
            ? Author::query()->select('id','name')->orderBy('name')->get()->toArray()
            : [];

        // Countries (if you have a Country model + relation)
        $this->allCountries = countries::whereExists(function ($query) {
        $query->select(DB::raw(1))
              ->from('repo')
              ->whereColumn('countries.id', 'repo.country_id');
            })
            ->orderBy('name')
            ->get()
            ->toArray();

        // Repo Types (optional; remove if PolicyBrief doesn't have types)
        $this->repo_types = class_exists(Repo_type::class)
            ? Repo_Type::query()->select('id','name')->orderBy('name')->get()->toArray()
            : [];

        // Distinct lists from PolicyBrief columns (adjust column names if different)
        $this->fields = PolicyBrief::query()
            ->whereNotNull('field')         // <-- change/remove if using a relation
            ->distinct()->orderBy('field')
            ->pluck('field')->filter()->values()->toArray();

        $this->subjects = PolicyBrief::query()
            ->whereNotNull('subject')       // <-- change/remove if using a relation
            ->distinct()->orderBy('subject')
            ->pluck('subject')->filter()->values()->toArray();

        $this->projects = PolicyBrief::query()
            ->whereNotNull('project')       // <-- change/remove if using a relation
            ->distinct()->orderBy('project')
            ->pluck('project')->filter()->values()->toArray();

        // Years list derived from publish_date (fallback to created_at)
        $this->publish_dates = PolicyBrief::query()
            ->selectRaw('YEAR(COALESCE(publish_date, created_at)) as y')
            ->whereNotNull(DB::raw('COALESCE(publish_date, created_at)'))
            ->distinct()->orderByDesc('y')
            ->pluck('y')->toArray();
            
        // Initial load
        $this->loadMore();
    }

    public function setType(string $typeId): void
    {
        // Toggle behavior (same as your Knowledge Hub buttons)
        if (in_array($typeId, $this->repo_type_ids, true)) {
            $this->repo_type_ids = array_values(array_diff($this->repo_type_ids, [$typeId]));
        } else {
            $this->repo_type_ids[] = $typeId;
        }
        $this->resetItems();
    }
    
    private function getQuery()
    {
        $q = PolicyBrief::query();

        // Visibility grouping (from earlier fix)
        $q->where(function ($v) {
            $v->whereNotNull('publish_date')
              ->where('publish_date', '<=', now())
              ->orWhereNull('publish_date');
        });

        // Search
        if (filled($this->search)) {
            $s = trim($this->search);
            $q->where(function ($qq) use ($s) {
                $qq->where('title', 'like', "%{$s}%")
                   ->orWhere('description', 'like', "%{$s}%");
            });
        }

        // ===== Apply filters (adjust to your schema) =====

        // Authors: if many-to-many relation -> whereHas('authors')
        if (!empty($this->selectedAuthorsIds)) {
            if (method_exists(PolicyBrief::class, 'authors')) {
                $ids = $this->selectedAuthorsIds;
                $q->whereHas('authors', fn($w) => $w->whereIn('authors.id', $ids));
            } else {
                // If you only have author_id on the table:
                $q->whereIn('author_id', $this->selectedAuthorsIds);
            }
        }

        // Fields / Subjects / Projects as columns
        if (!empty($this->selectedFields))   { $q->whereIn('field',   $this->selectedFields); }
        if (!empty($this->selectedSubjects)) { $q->whereIn('subject', $this->selectedSubjects); }
        if (!empty($this->selectedProjects)) { $q->whereIn('project', $this->selectedProjects); }

        // Countries: many-to-many -> whereHas('countries'), else country_id column
        if (!empty($this->selectedCountryIds)) {
            if (method_exists(PolicyBrief::class, 'countries')) {
                $ids = $this->selectedCountryIds;
                $q->whereHas('countries', fn($w) => $w->whereIn('countries.id', $ids));
            } else {
                $q->whereIn('country_id', $this->selectedCountryIds);
            }
        }

        // Repo Types (optional): many-to-many or simple column (e.g., type_id)
        if (!empty($this->repo_type_ids)) {
            if (method_exists(PolicyBrief::class, 'types')) {
                $ids = $this->repo_type_ids;
                $q->whereHas('types', fn($w) => $w->whereIn('repo_types.id', $ids));
            } else {
                $q->whereIn('repo_type_id', $this->repo_type_ids);
            }
        }

        // Years (publish dates)
        if (!empty($this->selectedPublishDates)) {
            $q->whereIn(DB::raw('YEAR(COALESCE(publish_date, created_at))'), $this->selectedPublishDates);
            // For SQLite or if YEAR() unsupported, switch to whereYear chains.
        }

        // Order
        $q->orderByRaw('publish_date IS NULL')
          ->orderBy('publish_date', 'desc')
          ->orderBy('created_at', 'desc');
          
        return $q;
    }
    
    public function loadMore(): void
    {
        $paginated = $this->getQuery()->paginate($this->perPage, ['*'], 'page', $this->pageNumber);
        
        $this->pageNumber++;
        $this->hasMorePages = $paginated->hasMorePages();
        
        $this->policyBriefs = $this->policyBriefs->merge($paginated->items());
    }
    
    private function resetItems(): void
    {
        $this->policyBriefs = new Collection();
        $this->pageNumber = 1;
        $this->hasMorePages = true;
        $this->loadMore();
    }

    public function render()
    {
        return view('livewire.new-work-policy-briefs', [
            // pass datasets the Blade expects
            'authors'        => $this->authors,
            'fields'         => $this->fields,
            'subjects'       => $this->subjects,
            'projects'       => $this->projects,
            'publish_dates'  => $this->publish_dates,
            'repo_types'     => $this->repo_types,
            'allCountries'   => $this->allCountries,
            'repo_type_ids'  => $this->repo_type_ids,
            'is_data_repo_page' => $this->is_data_repo_page,
        ]);
    }

    public function filterUpdated(): void
    {
        $this->resetItems();
    }

    public function clear(): void
    {
        $this->search               = '';
        $this->selectedAuthorsIds   = [];
        $this->selectedFields       = [];
        $this->selectedSubjects     = [];
        $this->selectedProjects     = [];
        $this->selectedPublishDates = [];
        $this->repo_type_ids        = [];
        $this->selectedCountryIds   = [];
        $this->resetItems();
    }

    public function clearSearch(): void
    {
        $this->search = '';
        $this->resetItems();
    }
}