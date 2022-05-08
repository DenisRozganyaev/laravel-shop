<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Listeners\OrderCreatedNotification;
use App\Listeners\UserLoginEventSubscriber;
use App\Listeners\UserLogoutEventSubscriber;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use App\Observers\ImageObserver;
use App\Observers\OrderObserver;
use App\Observers\ProductObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'Illuminate\Auth\Events\Login' => [
            UserLoginEventSubscriber::class
        ],
        'Illuminate\Auth\Events\Logout' => [
            UserLogoutEventSubscriber::class
        ],
        OrderCreated::class => [
            OrderCreatedNotification::class
        ]
    ];

    protected $observers = [
        Image::class => [ImageObserver::class],
        Product::class => [ProductObserver::class],
        Order::class => [OrderObserver::class]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
