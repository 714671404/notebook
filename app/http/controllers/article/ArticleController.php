<?php

namespace app\http\controllers\article;

use snoweddy\src\base\Controller;

class ArticleController extends Controller
{
    public function create()
    {
        return $this->view('article/article_create');
    }
}