<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Notifications extends Component
{
    // public $count = 3;

    public function getListeners()
{
    return [
        "echo-notification:App.Models.User." . auth()->id() . ",MakeMessage" => "render"
    ];
}

    public function getNotificationsProperty()
    {
        return auth()->user()->notifications;
    }



    public function readNotification($id)
    {
        auth()->user()->notifications->find($id)->markAsRead();
    }


    public function incrementCount()
    {

    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
