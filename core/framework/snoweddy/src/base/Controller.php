<?php

namespace snoweddy\src\base;

class Controller
{
    /*
     * 属性初始化
     */
    protected $_controller;
    protected $_action;
    protected $_view;

    public function __construct()
    {
        $this->_view = new View();
    }

    /*
     * 引用view的方法
     */
    protected function view($path, array $data = [])
    {
        $this->_view->view($path, $data);
    }


}