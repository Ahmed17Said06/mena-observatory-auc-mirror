<?php

namespace App\Http\Livewire;

use App\Models\Blogs;
use Livewire\Component;
use Livewire\WithPagination;

class BlogsPage extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.blogs-page', ['blogs' => Blogs::latest()->paginate(3, ['*'], 'blogsPage'),]);
    }
}
