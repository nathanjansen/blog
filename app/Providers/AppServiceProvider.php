<?php

namespace App\Providers;

use App\Support\Scribe\Scribe;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Scribe::path(base_path('pages/articles'));
    }
}
