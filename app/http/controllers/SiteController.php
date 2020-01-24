<?php

namespace app\http\controllers;

use snoweddy\src\base\Controller;

class SiteController extends Controller
{
    public function index()
    {
        return 1231231;
    }

    public function show($id, $name)
    {
        echo $id . '<hr>';
        echo $name;
        exit;
    }
}