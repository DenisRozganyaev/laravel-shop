<?php

namespace App\Observers;

use App\Jobs\OrderCreatedNotificationJob;
use App\Models\Order;
use App\Models\Role;

class OrderObserver
{
    public function created(Order $order)
    {
        OrderCreatedNotificationJob::dispatch($order->user, $order)->onQueue('email');
        $admin = Role::admin()->first()?->users()?->first();
        OrderCreatedNotificationJob::dispatch($admin, $order)->onQueue('email')->delay(10);
    }

    public function updated(Order $order)
    {
        OrderCreatedNotificationJob::dispatch($order->user, $order)->onQueue('email');
    }
}
