<?php

namespace snoweddy\src\base;

class Env
{
    public static function config($path = 'config')
    {
        $string = APP_PATH . DS . 'config' . DS;
        $config = [];
        if (strpos($path, '.') === false) {
            return include $string . $path . '.php';
        } else {
            $pathArray = explode('.', $path);
            $config = include $string . array_shift($pathArray) . '.php';
            if (count($pathArray) > 1) {
                foreach ($pathArray as $var) {
                    $config = $config[$var];
                }
            } else {
                $config = $config[array_shift($pathArray)];
            }
            return $config;
        }
    }
}