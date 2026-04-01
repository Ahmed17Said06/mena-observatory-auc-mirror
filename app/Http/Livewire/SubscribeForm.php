<?php

namespace App\Http\Livewire;

use App\Models\Subscriber;
use Livewire\Component;

class SubscribeForm extends Component
{
    public $email_sub = '';

    protected $rules = [
        'email_sub' => 'required|email|unique:subscribers,email',
    ];
    public $show;

    public function mount()
    {
//        session()->flush();
//        dd(session()->get('popup_closed', false));
        $this->show = !session()->get('popup_closed', false);
    }
    public function subscribe()
    {
        $this->validate();

        Subscriber::create(['email' => $this->email_sub]);

        $this->reset('email_sub');

        session()->flash('message', 'Subscribed successfully.');
    }

    public function render()
    {
        return view('livewire.subscribe-form');
    }

    public function close()
    {
        // Set a session variable 'popup_closed' to true when the pop-up is closed
        session()->put('popup_closed', true);
        $this->show = false;
        $this->dispatchBrowserEvent('formClosed');

    }
}
