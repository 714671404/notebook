<?php


namespace snoweddy\src\base;


class View
{
    protected $variable = [];

    /*
     * 分配变量并且引入视图
     */
    public function view($path, array $data = [])
    {
        extract($data);

        $content = APP_PATH . '/app/http/views/' . $path . '.php';

        //判断视图文件是否存在
        if (is_file($content)) {
            include $content;
        } else {
            echo "<h1 style='color: red;'>无法找到视图文件!</h1>";
        }
    }
}