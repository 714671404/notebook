<?php

namespace snoweddy\src\base;

class Env
{
    public static function config($path = 'config')
    {
        return include APP_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $path . '.php';
    }
}