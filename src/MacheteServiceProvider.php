<?php

namespace Displore\Machete;

use Illuminate\Support\ServiceProvider;

class MacheteServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
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
    }

    /**
     * Register any package services.
     */
    public function register()
    {
        // Binding the themes service if not disabled.
        if ($this->app->config->has('displore.services.themes')) {
            if ($this->app->config->get('displore.services.themes') == true) {
                $this->bindThemesService();
            }
        } else {
            $this->bindThemesService();
        }

        // Binding the widgets service if not disabled.
        if ($this->app->config->has('displore.services.widgets')) {
            if ($this->app->config->get('displore.services.widgets') == true) {
                $this->bindWidgetsService();
            }
        } else {
            $this->bindWidgetsService();
        }
    }

    protected function bindThemesService()
    {
        $this->app->registerDeferredProvider(
            'Displore\Themes\ThemesServiceProvider',
            'Displore\Themes\Theme'
        );

        // The commands are not necessary on production servers.
        if ($this->app->environment('local')) {
            $this->commands(['Displore\Themes\ThemeCommand']);
        }
    }

    protected function bindWidgetsService()
    {
        $this->app->register('Displore\Widgets\WidgetsServiceProvider');
    }

    protected function bindDirectives()
    {
        $directives = new Directives();

        $directives->datetime();
        $directives->ifLoggedIn();
        $directives->layout();
        $directives->limit();
        $directives->partial();
        $directives->title();
    }
}
