<?php

namespace App\Http\Livewire;

use App\Models\Repo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CountryRepoList extends Component
{
    use WithPagination;

    public $country_id;

    protected $paginationTheme = 'bootstrap';

    public function mount($country_id)
    {
        $this->country_id = $country_id;
    }

    public function render(): View|Factory|Application
    {
        $repos = Repo::query()
            ->where('country_id', $this->country_id)
            ->with('tags')
            ->latest()
            ->paginate(6); // Changed from 3 to 6

        return view('livewire.country-repo-list', ['repos' => $repos]);
    }
}