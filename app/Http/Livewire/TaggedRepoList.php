<?php

namespace App\Http\Livewire;

use App\Models\Repo;
use App\Models\Repo_tags;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class TaggedRepoList extends Component
{
    public Collection $repos;
    public string $tagName = '';
    public string $search = '';

    public int $pageNumber = 1;
    public int $perPage = 6;
    public bool $hasMorePages = true;

    public function mount(string $tagName)
    {
        $this->tagName = $tagName;
        $this->repos = new Collection();
        $this->loadMore();
    }

    private function getQuery()
    {
        return Repo::whereHas('tags', function ($q) {
                $q->where('name', $this->tagName);
            })
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->with('tags', 'pdfFiles')
            ->latest('publish_date');
    }

    public function loadMore(): void
    {
        $paginated = $this->getQuery()->paginate($this->perPage, ['*'], 'page', $this->pageNumber);
        $this->pageNumber++;
        $this->hasMorePages = $paginated->hasMorePages();
        $this->repos = $this->repos->merge($paginated->items());
    }

    private function resetItems(): void
    {
        $this->repos = new Collection();
        $this->pageNumber = 1;
        $this->hasMorePages = true;
        $this->loadMore();
    }

    public function updatingSearch(): void
    {
        $this->resetItems();
    }

    public function render()
    {
        return view('livewire.tagged-repo-list');
    }
}
