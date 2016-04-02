<?php

namespace Displore\Machete;

use Illuminate\Support\ServiceProvider;

class MacheteServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Adding all of the Blade directives if not disabled.
        if ($this->app->config->has('displore.services.directives')) {
            if ($this->app->config->get('displore.services.directives') == true) {
                $this->bindDirectives();
            }
        } else {
            $this->bindDirectives();
        }

        // Resolving configuration.
        $this->publishes([
            __DIR__.'/../config/machete.php' => config_path('displore/machete.php'),
        ], 'displore.machete.config');
        $this->mergeConfigFrom(__DIR__.'/../config/machete.php', 'displore.machete');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // Binding the theme service if not disabled.
        if ($this->app->config->has('displore.services.theme')) {
            if ($this->app->config->get('displore.services.theme') == true) {
                $this->bindThemeService();
            }
        } else {
            $this->bindThemeService();
        }
    }

    protected function bindThemeService()
    {
        $this->app->registerDeferredProvider(
            'Displore\Machete\Theme\ThemeServiceProvider',
            'Displore\Machete\Theme\Theme'
        );

        // The commands are not necessary on production servers.
        if ($this->app->environment('local')) {
            $this->commands(['Displore\Machete\Theme\ThemeCommand']);
        }
    }

    protected function bindDirectives()
    {
        $directives = new Directives;

        $directives->datetime();
        $directives->ifLoggedIn();
        $directives->layout();
        $directives->limit();
        $directives->partial();
        $directives->title();
    }
}
