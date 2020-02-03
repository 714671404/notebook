<?php

namespace snoweddy\src\route;

Route::get('/', 'home\HomeController@index');

// 文章路由
Route::get('/article/create', 'article\ArticleController@create');
Route::post('/article', 'article\ArticleController@store');

Route::get('/dome', function () {
    return view('dome/dome');
});

Route::get('/test', function () {
    return json_encode([
        'data' => [$_GET['user'], $_GET['pass']],
        'statucCode' => 200
    ]);
});
Route::post('/test', function () {
    return json_encode([
        'data' => [$_POST['user'], $_POST['pass']],
        'statucCode' => 200
    ]);
});