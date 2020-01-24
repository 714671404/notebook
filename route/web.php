<?php

use snoweddy\src\route\Route;

Route::get('/', 'IndexController@index');
Route::get('site/{id}/show/{name}', 'SiteController@show');
Route::get('abc', function () {
    return 111;
});
