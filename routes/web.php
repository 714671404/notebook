<?php

namespace snoweddy\src\route;

Route::get('/', 'home\HomeController@index');

// 文章路由
Route::get('/article/create', 'article\ArticleController@create');
Route::post('/article/create', 'article\ArticleController@store');

Route::get('/dome', function () {
    return view('dome/dome');
});

Route::get('/test', function () {
    unset($_GET['s']);
//    http_response_code(403);
    return json_encode([
        'data' => $_GET,
        'statusCode' => 200
    ]);
});
Route::post('/test', function () {
    return json_encode([
        'data' => [$_POST['user'], $_POST['pass']],
        'statucCode' => 200
    ]);
});

/*
 * 苟江response模块
 * 使用http_response_code，json_encode函数创建一个返回json并且待状态码的类
 */