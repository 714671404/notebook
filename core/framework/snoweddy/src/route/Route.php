<?php

namespace snoweddy\src\route;

class Route
{
    private static $route = [];
    public static function init()
    {
        include APP_PATH . '/route/web.php';
        self::rule();
    }

    /*
     * get方法
     */
    public static function get($rule, $route)
    {
        self::$route[$rule] = $route;
    }

    /*
     * 路由核心代码
     */
    public static function rule()
    {
        $data = [];
        $url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $url_count = count($url);
        foreach (self::$route as $key => $var) {
            $rule = explode('/', trim($key, '/'));

            $rule_count = count($rule);
            if ($rule_count !== $url_count) {
                continue;
            }

            foreach ($rule as $k => $v) {
                if ($v === $url[$k]) {
                    $rule_count --;
                    continue;
                } else if (preg_match('/^\{\w+\}/i', $v)) {
                    $data[] = $url[$k];
                    $rule_count --;
                    continue;
                }
            }
            if ($rule_count === 0) {
                if (is_string($var)) {
                    $str = 'app\\http\\controllers\\';
                    $v_arr = explode('@', $var);
                    $str .= array_shift($v_arr);
                    $str = str_replace('/', DIRECTORY_SEPARATOR, $str);
                    $controller = new $str();
                    call_user_func_array([$controller, $v_arr[0]], $data);
                    break;
                } else if (is_object($var)) {
                    print_r($var());
                }
            }
        }
    }
}