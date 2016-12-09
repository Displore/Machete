<?php

if (!function_exists('isRoute')) {

    /**
     * Determine if the given route is the current one.
     *
     * @param string $route
     * @param string $output
     *
     * @return bool
     */
    function isActive($route, $output = 'active')
    {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }
}
