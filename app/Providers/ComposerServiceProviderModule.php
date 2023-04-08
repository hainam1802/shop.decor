<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProviderModule extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'admin._layouts.includes.sidebar',
            'App\Http\ViewComposers\ModuleComposer'
        );
    }
}
