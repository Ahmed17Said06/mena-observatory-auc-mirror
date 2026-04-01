<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Events;

class Calendar extends Component
{
    public $events = [];
    public $eventDetails = null;
    protected $listeners = ['showEventDetails' => 'showEventDetails'];

    public function mount()
    {
        $this->events = Events::all();
    }

    public function showEventDetails($eventId)
    {
        $this->eventDetails = Events::find($eventId);
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
