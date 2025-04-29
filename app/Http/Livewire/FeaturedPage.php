<?php

namespace App\Http\Livewire;

use App\Models\FeaturedPost;
use Livewire\Component;
use Livewire\WithPagination;

class FeaturedPage extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.featured-page', ['featuredPosts' => FeaturedPost::latest()->paginate(3, ['*'], 'featuredPage'),]);
    }
}
