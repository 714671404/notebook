<?php

use snoweddy\src\route\Route;

Route::get('/', 'IndexController@index');
Route::get('site/{id}/show/{name}', 'SiteController@show');
Route::get('abc', function () {
    return $_SERVER['REQUEST_METHOD'];
});

Route::get('register', 'auth\RegisterController@register');

Route::post('test', function () {
    return 1;
});
