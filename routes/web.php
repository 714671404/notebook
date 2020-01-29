<?php

namespace snoweddy\src\route;

Route::get('/', 'home\HomeController@index');

// 文章路由
Route::get('/article/create', 'article\ArticleController@create');
Route::post('/article', 'article\ArticleController@store');

Route::get('/dome', function () {
    return view('dome/dome');
});