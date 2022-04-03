<?php

namespace App\Providers;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Models\Image;
use App\Repositories\Contracts\IOrderRepository;
use App\Repositories\OrderRepository;
use Illuminate\Support\ServiceProvider;

class OrderRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
          IOrderRepository::class,
          OrderRepository::class
        );
    }
}
