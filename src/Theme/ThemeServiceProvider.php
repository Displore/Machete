<?php

namespace Displore\Machete\Theme;

use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Defer loading until service is called.
     * 
     * @var bool
     */
    protected $defer = true;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // Binding Theme class to the facade.
         $this->app->singleton('theme', function () {
            return $this->app->make('Displore\Machete\Theme\Theme');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return[Theme::class];
    }
}
