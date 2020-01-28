<?php

namespace app\http\controllers;

use snoweddy\src\base\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return '欢迎使用snoweddy';
    }
}