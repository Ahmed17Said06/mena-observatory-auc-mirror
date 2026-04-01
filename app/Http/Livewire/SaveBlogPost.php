<?php

namespace App\Http\Livewire;

use App\Models\Repo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class SaveBlogPost extends Component
{
    public $blogId;
    public $loading = false;
    public $alreadySaved = false;

    public function mount($blogId)
    {
        $this->blogId = $blogId;
        if (Auth::check()) {
            $this->alreadySaved = Auth::user()->repos()->where('repo.id', $this->blogId)->exists();
        }
    }

    public function togglePost()
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->loading = true;

        // Get the blog post
        $blog = Repo::find($this->blogId);

        // Toggle the blog post
        if ($this->alreadySaved) {
            Auth::user()->repos()->detach($blog);
            $this->alreadySaved = false;
        } else {
            Auth::user()->repos()->attach($blog);
            $this->alreadySaved = true;
        }

        $this->loading = false;

        // Update the component
        $this->emit('postSaved');
    }

    public function render()
    {
        return view('livewire.save-blog-post');
    }
}
