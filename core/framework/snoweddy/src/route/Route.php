<?php

namespace snoweddy\src\route;

class Route
{
    public static function init()
    {
        self::rule();
    }

    /*
     * 路由核心代码
     */
    public static function rule()
    {
        $controllerName = 'Index';
        $actionName = 'index';
        $param = [];
        $url = str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['REQUEST_URI']);

        $position = strpos($url, '?');

        $url = $position === false ? $url : substr($url, 0, $position);

        $url = trim($url, '/');

        if ($url) {
            $urlArray = array_filter(explode('/', $url));
            // Route::get('index', 'Home\Index@index')
            $controllerName = array_shift($urlArray);
            $actionName = array_shift($urlArray);
            $param = $urlArray;
        }

        $controllerName = 'app\\http\\controllers\\' . ucfirst($controllerName) . 'Controller';

        $dispatch = new $controllerName();

        $result = call_user_func_array([$dispatch, $actionName], $param);

        if ($result !== false) {
            print_r($result);
        }
    }
}