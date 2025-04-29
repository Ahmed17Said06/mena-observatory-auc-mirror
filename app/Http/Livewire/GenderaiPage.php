<?php

namespace App\Http\Livewire;

use App\Models\GenderAi;
use Livewire\Component;
use Livewire\WithPagination;

class GenderaiPage extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.genderai-page', ['gender_ai' => GenderAi::latest()->paginate(3, ['*'], 'genderaiPage'),]);
    }
}
