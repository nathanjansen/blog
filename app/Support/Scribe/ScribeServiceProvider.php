<?php

namespace App\Support\Scribe;

use App\Support\Scribe\Blade\ScribeBladeCompiler;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Folio\FolioManager;

class ScribeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Scribe::registerArticles();
    }

    public function register()
    {
        $this->app->singleton(FolioManager::class);

        $this->app->singleton('blade.compiler', fn() => new ScribeBladeCompiler(
            $this->app['files'],
            $this->app['config']['view.compiled']
        ));
    }
}
