<?php

namespace App\Http\Livewire;

use App\Models\Events;
use Illuminate\Support\Collection;
use Livewire\Component;

class EventsSection extends Component
{
    public Collection $events;
    public $calendarEvents;

    public $eventDetails = null;
    public $isMonthView = true;
    public string $searchInput= '';
    public $pageNumber = 1;

    public $hasMorePages;
    protected $listeners = ['showEventDetails' => 'showEventDetails'];

    public function mount()
    {
        $this->events = new Collection();
        $this->calendarEvents = Events::where('start_date','>',now())->get();

        $this->loadPosts();
        $this->eventDetails = $this->calendarEvents->first();
    }
    public function loadPosts()
    {
        $posts = Events::where('start_date','>',now())->orderBy('start_date')->when($this->searchInput!='', function ($q) {
            return $q->where('title','like','%'.$this->searchInput.'%');
        })->paginate(5, ['*'], 'page', $this->pageNumber);
        $this->pageNumber += 1;

        $this->hasMorePages = $posts->hasMorePages();

        $this->events->push(...$posts->items());
    }
    public function showEventDetails($eventId)
    {
        $this->eventDetails = Events::find($eventId);
        $this->dispatchBrowserEvent('calendarUpdated');

    }

    public function render()
    {
        return view('livewire.events-section');
    }

    public function switchView()
    {
        $this->isMonthView = !$this->isMonthView;
        $this->dispatchBrowserEvent('calendarUpdated');
        $this->events = new Collection();

        $this->pageNumber = 1;
        $this->loadPosts();
//        dd($this->events);

    }

    public function search()
    {
        $this->events = Events::where('start_date','>',now())->when($this->searchInput!='', function ($q) {
        return $q->where('title','like','%'.$this->searchInput.'%');
    })->limit(5)->get();
        $this->pageNumber = 2;
        $this->calendarEvents = Events::where('start_date','>',now())->when($this->searchInput!='', function ($q) {
            return $q->where('title','like','%'.$this->searchInput.'%');
        })->get();
        $this->dispatchBrowserEvent('eventsUpdated',$this->calendarEvents);
    }
}
