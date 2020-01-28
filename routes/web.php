<?php

namespace snoweddy\src\route;

Route::get('/', 'home\HomeController@index');
Route::get('/article/create', 'article\ArticleController@create');
