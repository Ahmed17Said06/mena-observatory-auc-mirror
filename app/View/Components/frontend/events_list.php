<?php

namespace App\View\Components\frontend;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class events_list extends Component
{
    private Collection $events;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($events)
    {
        $this->events = $events;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.events_list');
    }
}
