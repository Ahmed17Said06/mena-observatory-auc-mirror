<?php

namespace App\Http\Livewire;

use App\Models\Aswat;
use App\Models\Partner;
use Livewire\Component;
use Livewire\WithPagination;

class Aswats extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.aswats', ['aswats' => Aswat::latest()->paginate(3),]);
    }
}
