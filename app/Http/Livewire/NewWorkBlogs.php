<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\NewWorkBlog;

class NewWorkBlogs extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $newWorkBlogs = NewWorkBlog::published()
            ->orderBy('publish_date', 'desc')
            ->paginate(3, ['*'], 'newWorkBlogsPage');

        return view('livewire.new-work-blogs', [
            'newWorkBlogs' => $newWorkBlogs
        ]);
    }
}