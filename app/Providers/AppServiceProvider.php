<?php

namespace App\Providers;

use App\Repositories\CommentsRepository;
use App\Repositories\Contracts\ICommentsRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        ICommentsRepository::class => CommentsRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();

        view()->composer('navigation.parts.language_switcher', function($view) {
           $view->with('current_locale', app()->getLocale());
           $view->with('available_locales', config('constants.locales.available'));
        });
    }
}
