<?php

namespace App\Listeners;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserLogoutEventSubscriber
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (Cart::instance('cart')->count() > 0) {
            Cart::instance('cart')->store($event->user->instance_cart_name);
        }
        if (Cart::instance('wishlist')->count() > 0) {
            Cart::instance('wishlist')->store($event->user->instance_cart_name);
        }
    }
}
