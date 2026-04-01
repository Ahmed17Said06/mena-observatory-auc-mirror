<?php

namespace App\Http\Livewire;

use App\Models\News;
use App\Models\Repo;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCommunityRepos extends Component
{
    use WithPagination;


    public $community;

    public function mount($community = null)
    {
        $this->community = $community;
    }

    public function render()
    {
        return view('livewire.show-community-repos', [
            'repos' => $this->community->repos()->paginate(3),
        ]);

    }


}
