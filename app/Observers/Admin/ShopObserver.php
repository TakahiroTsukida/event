<?php

namespace App\Observers\Admin;

use App\Admin\Shop;

class ShopObserver
{
    /**
     * Handle the shop "created" event.
     *
     * @param  \App\Admin\Shop  $shop
     * @return void
     */
    public function created(Shop $shop)
    {
        //
    }

    /**
     * Handle the shop "updated" event.
     *
     * @param  \App\Admin\Shop  $shop
     * @return void
     */
    public function updated(Shop $shop)
    {
        //
    }


    public function deleting(Shop $shop)
    {
        $shop->events()->each(function ($event) {
            $event->delete();
        });
    }

    
    /**
     * Handle the shop "deleted" event.
     *
     * @param  \App\Admin\Shop  $shop
     * @return void
     */
    public function deleted(Shop $shop)
    {
        //
    }

    /**
     * Handle the shop "restored" event.
     *
     * @param  \App\Admin\Shop  $shop
     * @return void
     */
    public function restored(Shop $shop)
    {
        //
    }

    /**
     * Handle the shop "force deleted" event.
     *
     * @param  \App\Admin\Shop  $shop
     * @return void
     */
    public function forceDeleted(Shop $shop)
    {
        //
    }
}
