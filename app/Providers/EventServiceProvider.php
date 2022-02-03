<?php

namespace App\Providers;

use App\Events\OrderDeleted;
use App\Events\TicketUpdated;
use App\Listeners\ChangeStatusWhenOrderDeleted;
use App\Listeners\TicketNotifiction;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
/*        TicketUpdated::class=>[
            TicketNotifiction::class
            ],*/
//        OrderDeleted::class=>[
//            ChangeStatusWhenOrderDeleted::class
//        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
