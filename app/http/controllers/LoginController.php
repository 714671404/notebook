<?php

namespace app\http\controllers;

use app\http\models\User;
use snoweddy\src\base\Controller;

class LoginController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }
    public function login()
    {
        $user = $this->user->add_user([
            'name' => '小安',
            'username' => 'snoweddy',
            'password' => 'yuefei12',
            'email' => 'snoweddy@163.com',
            'phone' => '15045863415'
        ]);

        dd($user);
    }
}