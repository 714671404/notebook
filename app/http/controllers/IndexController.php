<?php

namespace app\http\controllers;

use snoweddy\src\base\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this->render('index/index');
    }
}