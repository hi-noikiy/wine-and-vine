<?php

if (! function_exists('set_active')) {
    /**
     * @param string $uri Current path
     * @param string $active CSS class
     * @return string returns the CSS class if the Request in on the specified URI or Empty string if not
     */
    function set_active($uri, string $active = 'active') : string
    {
        return request()->is($uri) ? $active : '';
    }
}

if (!function_exists('to')) {

    /**
     * @param string $name Route name
     * @param array $parameters Additional parameters
     * @return string
     */
    function to(string $name, $parameters = []): string
    {
        return route($name, $parameters, false);
    }
}