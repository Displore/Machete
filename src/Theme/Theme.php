<?php

namespace Displore\Machete\Theme;

use View;
use Cache;
use Config;

class Theme
{
    /**
     * Contains the current theme.
     * 
     * @var string
     */
    protected $theme;

    /**
     * The default theme.
     * 
     * @var string
     */
    protected $default;

    /**
     * The configured location of all themes and assets.
     * @var array
     */
    protected $locations;

    /**
     * Set the current theme.
     * 
     * @param  string $theme
     * @return $this
     */
    public function set($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get the current theme, or else the default.
     * 
     * @return string
     */
    public function get()
    {
        return (isset($this->theme)) ? $this->theme : $this->getDefault();
    }

    /**
     * Set the default theme.
     * 
     * @param string $theme
     */
    public function setDefault($theme)
    {
        $this->default = $theme;
    }

    /**
     * Get the default theme.
     * 
     * @return string
     */
    public function getDefault()
    {
        if (isset($this->default)) {
            return $this->default;
        }

        return $this->getFromConfig();
    }

    /**
     * Get the theme from the config, or else the default one.
     * 
     * @return string
     */
    public function getFromConfig()
    {
        if (Config::has('machete.theme')) {
            return Config::get('machete.theme');
        } elseif (Config::has('machete.default')) {
            return Config::get('machete.default');
        }

        throw new \Exception('The (default) theme is not set.');
    }

    /**
     * Get the theme from the cache. Caching can be disabled in the config.
     * If no theme is cached, the result of get() is cached.
     * 
     * @return string
     */
    public function getFromCache()
    {
        if (Config::get('machete.cache')) {
            return Cache::rememberForever('machete.theme', function () {
                return $this->get();
            });
        }

        return false;
    }

    /**
     * Register the theme paths in the view finder.
     * 
     * @return void
     */
    public function register()
    {
        $theme = $this->get();
        $path = $this->location('themes').'/'.$theme;

        View::addLocation($path);
        View::addNamespace('theme', $path);
    }

    /**
     * Generate an asset path for a themed asset.
     * 
     * @param  string $file
     * @param  bool   $secure
     * @return mixed
     */
    public function asset($file, $secure = null)
    {
        $theme = $this->get();
        $path = $this->location('assets').'/'.$theme.'/'.$file;

        return app('url')->asset($path, $secure);
    }

    /**
     * Get the location of a directory, specified in the config.
     * 
     * @param  string $dir
     * @return string
     */
    protected function location($dir)
    {
        if ( ! isset($this->locations[$dir])) {
            $this->locations[$dir] = Config::get('machete.locations.'.$dir);
        }

        return $this->locations[$dir];
    }
}
