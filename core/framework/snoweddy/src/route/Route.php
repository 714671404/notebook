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
        if ((strpos($rule, '{') === false) && (strpos($rule, '}') === false)) {
            self::$route['y'][$rule] = $route;
        } else {
            self::$route['n'][$rule] = $route;
        }
    }

    /*
     * 路由核心代码
     */
    public static function rule()
    {
        /*
         * 静态属性$route是一个二维数组，
         * 键值'y'存放没有参数的路由，
         * 键值'n'存放有参数的路由
         */
        $data = [];
        $route = '';
        $controller = '';
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $url = $url ? $url : '/';

        if (array_key_exists($url, self::$route['y'])) {
            $route = self::$route['y'][$url];
        } else {
            $url = explode('/', $url);
            $url_count = count($url);
            foreach (self::$route['n'] as $key => $var) {
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
                    $route = $var;
                }
            }
        }
        if (is_string($route)) {
            $route = explode('@', $route);
        } elseif (is_object($route)) {
            return print_r(call_user_func_array($route, $data));
        }
        $controller = 'app\\http\\controllers\\' . array_shift($route);
        $dispatch = new $controller();
        return call_user_func_array([$dispatch, $route[0]], $data);
    }

    public static function __callStatic($method, $params)
    {
        /*
         * 使用 $_SERVER['REQUEST_METHOD']与__callStatic魔术方法
         * 实现get与post方法，与request方法获取参数
         */
        echo $_SERVER['REQUEST_METHOD'] . '<hr>';
        echo $method;
        echo '<hr>';
        dd($params);
    }

    private function instantiate($class)
    {

    }
}