<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Contact\ContactServiceInterface;
use App\Services\Contact\ContactService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
           $this->app->bind(ContactServiceInterface::class, ContactService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
