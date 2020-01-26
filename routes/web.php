<?php

namespace snoweddy\src\route;

Route::get('/', 'IndexController@index');
Route::get('site/{id}/show/{name}', 'SiteController@show');
Route::get('/abc', function () {
    return $_SERVER['REQUEST_METHOD'];
});

Route::get('login', 'auth\RegisterController@register');
Route::get('register', 'auth\RegisterController@register');

Route::post('test', function () {
    return 1;
});
Route::post('abc', 'auth\RegisterController@register');
