<?php

namespace App\Providers;

use App\Services\LoadDocsService;
use Illuminate\Support\ServiceProvider;

class LoadDocsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LoadDocsService::class, function () {
            return new LoadDocsService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
