<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProviderLanguage extends ServiceProvider
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
            'admin._layouts.includes.header',
            'App\Http\ViewComposers\LanguageAllComposer'
        );
    }
}
