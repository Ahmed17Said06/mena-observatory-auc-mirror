<?php

namespace App\Http\Livewire;

use App\Models\Events;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SaveEventWithText extends Component
{
    public $eventId;
    public $loading = false;
    public $alreadySaved = false;

    public function mount($eventId)
    {
        $this->eventId = $eventId;
        if (Auth::check()) {
            $this->alreadySaved = Auth::user()->events()->where('events.id', $this->eventId)->exists();
        }
    }

    public function toggleEvent()
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->loading = true;

        // Get the event
        $event = Events::find($this->eventId);

        // Toggle the event
        if ($this->alreadySaved) {
            Auth::user()->events()->detach($event);
            $this->alreadySaved = false;
            $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'Removed calendar Successfully!']);
        } else {

            Auth::user()->events()->attach($event);
            $this->alreadySaved = true;
            $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'Saved to calendar Successfully!']);
        }

        $this->loading = false;

        // Update the component
        $this->emit('eventSaved');
    }

    public function render()
    {
        return view('livewire.save-event-with-text');
    }
}

