<?php

namespace App\Http\Livewire;

use App\Models\Community;
use App\Models\News;
use App\Models\Partner;
use Livewire\Component;
use Livewire\WithPagination;

class Communities extends Component
{
    use WithPagination;

    public $search = '';

    public function updateSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.communities', [
            'blogs' => Community::where('name', 'like', '%'.$this->search.'%')->orderBy('name', 'asc')->get(),
        ]);
    }
}
