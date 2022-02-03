<?php

namespace App\Listeners;

use App\Events\TicketUpdated;
use App\Jobs\DeleteNotification;
use App\Notification;
use App\Ticket;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class TicketNotifiction
{
    /**
     * Create the event listener.
     *
     * @return void
     */




    /**
     * Handle the event.
     *
     * @param TicketUpdated $event
     * @return void
     */
    public function handle(TicketUpdated $event)
    {
        $notification = new Notification();
        $notification->title = trans("جواب تیکت:").$event->ticket->title;
        $notification->user_id = $event->ticket->user_id;
        $notification->description = $event->ticket->answer;
        $notification->save();

    }
}
