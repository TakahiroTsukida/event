<?php

namespace App\Observers\Admin;

use App\Admin\Event;

class EventObserver
{
    /**
     * Handle the event "created" event.
     *
     * @param  \App\Admin\Event  $event
     * @return void
     */
    public function created(Event $event)
    {
        //
    }

    /**
     * Handle the event "updated" event.
     *
     * @param  \App\Admin\Event  $event
     * @return void
     */
    public function updated(Event $event)
    {
        //
    }



    public function deleting(Event $event)
    {
        $event->prices()->each(function ($price) {
            $price->delete();
        });

        $event->schedules()->each(function ($schedule) {
            $schedule->delete();
        });

        $event->reservation_seats()->each(function ($reservation_seat) {
            $reservation_seat->delete();
        });
    }


    /**
     * Handle the event "deleted" event.
     *
     * @param  \App\Admin\Event  $event
     * @return void
     */
    public function deleted(Event $event)
    {

    }

    /**
     * Handle the event "restored" event.
     *
     * @param  \App\Admin\Event  $event
     * @return void
     */
    public function restored(Event $event)
    {
        //
    }

    /**
     * Handle the event "force deleted" event.
     *
     * @param  \App\Admin\Event  $event
     * @return void
     */
    public function forceDeleted(Event $event)
    {
        //
    }
}
