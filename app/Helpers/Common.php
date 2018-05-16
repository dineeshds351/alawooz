<?php

/* 
 * Custom Functions
 */

if (! function_exists('get_profile_image')) {
    /**
     * Return profile image of admin user.
     *
     * @param  string  $path
     * @return string
     */
    function get_profile_image($path) {
        return $path ? asset($path) : asset('dist/img/avatar5.png');
    }
}

if (! function_exists('set_active')) {
    /**
     * Return active class if current route match with given routes.
     *
     * @param  string/array  $route
     * @return string
     */
    function set_active($routes, $active = 'active') {
            $current = Route::currentRouteName();
            if(!is_array($routes)) {
                $routes = [$routes];
            }
            foreach($routes as $route) {
                if($current == $route) {
                    return $active;
                }
                if(substr($route, -2) == '.*' && preg_match('/^' . substr($route, 0, -2) . '/', $current)) {
                    return $active;
                }
            }
            return null;
    }
}