<?php

namespace App\Observers;

use App\Jobs\OrderCreatedNotificationJob;
use App\Models\Order;
use App\Notifications\Telegram\OrderStatusChangedNotification;

class OrderObserver
{
    public function created(Order $order)
    {
//        OrderCreatedNotificationJob::dispatchSync($order); //->onQueue('email');
    }

    public function updated(Order $order)
    {
//        OrderCreatedNotificationJob::dispatchSync($order); //->onQueue('email');
//        if ($order->status_id !== $order->getOriginal('status_id')) {
//            $order->notify(
//                (new OrderStatusChangedNotification($order))->onQueue('telegram')
//            );
//        }
    }
}
