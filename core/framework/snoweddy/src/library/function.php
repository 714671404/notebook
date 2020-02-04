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
if (!function_exists('dd')) {
    function dd($values)
    {
        echo '<pre>';
        print_r($values);
        echo '</pre>';
        exit;
    }
}
if (!function_exists('view')) {
    function view($path, array $data = [])
    {
        return (new snoweddy\src\base\View())->view($path, $data);
    }
}
if (!function_exists('response')) {
    function response(array $data, $statusCode = 200)
    {
        return (new snoweddy\src\library\Response())->json($data, $statusCode);
    }
}