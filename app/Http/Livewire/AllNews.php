<?php

namespace App\Http\Livewire;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class AllNews extends Component
{
    use WithPagination;

    public $search = '';

    public function updateSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.news', [
            'blogs' => News::where('title', 'like', '%'.$this->search.'%')->paginate(6),
        ]);
    }
}
