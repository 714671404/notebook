<?php

if (!function_exists('config')) {
    function config($path)
    {
        return snoweddy\src\base\Env::config($path);
    }
}
if (!function_exists('db')) {
    function db()
    {
        return snoweddy\src\db\DB::init();
    }
}