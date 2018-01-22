<?php

if (!function_exists('on_page')) {
    /**
     * Determine if the visitor is on the given page.
     * This uses the URL path.
     *
     * @param string $path
     *
     * @return bool
     */
    function on_page($path)
    {
        return request()->is($path);
    }
}

if (!function_exists('on_route')) {
    /**
     * Determine if the visitor is on the given page.
     * This uses the named route.
     *
     * @param string $route
     *
     * @return bool
     */
    function on_route($route)
    {
        return request()->routeIs($route);
    }
}

if (!function_exists('return_if')) {
    /**
     * Return the value if the condition is true.
     *
     * @param mixed $condition
     * @param mixed $value
     *
     * @return void
     */
    function return_if($condition, $value)
    {
        if ($condition) {
            return $value;
        }
    }
}
