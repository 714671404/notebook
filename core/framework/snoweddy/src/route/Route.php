<?php

namespace snoweddy\src\route;

class Route
{
    private static $route = [];
    private static $method;
    public static function init()
    {
        include APP_PATH . '/routes/web.php';
        self::route();
    }

    /*
     * 判断是get还是post请求
     */
    private static function route()
    {
        self::rule(strtolower($_SERVER['REQUEST_METHOD']));
    }

    /*
     * 路由核心代码
     */
    private static function rule($method)
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $url = $url ? $url : '/';
        $controller = '';
        $action = '';
        $params = [];
        $dispatch = null;
        $route = null;
        if ($method === 'get') {
            $getArray = self::$route['get'];
            if (array_key_exists($url, $getArray['no_params'])) {
                $route = $getArray['no_params'][$url];
            } else {
                $result = self::parsing($url, $getArray['have_params']);
                if (is_array($result)) {
                    $route = $result['route'];
                    $params = $result['params'];
                } elseif (is_string($result)) {
                    $route = $result;
                }
            }

        } elseif ($method === 'post') {
            $postArray = self::$route['post'];
            $route = self::parsing($url, $postArray);
        }

        if (is_string($route)) {
            $route = explode('@', $route);
        } elseif (is_object($route)) {
            return print_r(call_user_func_array($route, $params));
        }
        $controller = 'app\\http\\controllers\\' . array_shift($route);
        $dispatch = new $controller();
        return print_r(call_user_func_array([$dispatch, $route[0]], $params));
    }

    /*
     * 处理uri
     */
    private static function parsing($route, $data)
    {
        /*
         * 1）$url 拆分url
         * 2）便利have_params找到与url相似的键值对
         */
        $route = explode('/', $route);
        $params = [];
        $routeLength = count($route);
        foreach ($data as $key => $var) {
            $key = trim($key, '/');
            if ($key) {
                $rule = explode('/', $key);
                $ruleLength = count($rule);
                if ($routeLength !== $ruleLength) {
                    continue;
                }
                foreach ($rule as $k => $v) {
                    if ($v === $route[$k]) {
                        $ruleLength --;
                        continue;
                    } else if (preg_match('/^\{\w+\}/i', $v)) {
                        $params[] = $route[$k];
                        $ruleLength --;
                        continue;
                    }
                }
                if ($ruleLength === 0) {
                    $route = $var;
                    break;
                }
            }
        }
        if (empty($params)) {
            return $route;
        }
        return [
            'route' => $route,
            'params' => $params
        ];
    }

    public static function __callStatic($method, $params)
    {
        /*
         * 判断是get请求或者post请求
         */
        $rule = $params[0];
        $route = $params[1];
        if ($method === 'get') {
            if ((strpos($rule, '{') === false) && (strpos($rule, '}') === false)) {
                self::$route[$method]['no_params'][$rule] = $route;
            } else {
                self::$route[$method]['have_params'][$rule] = $route;;
            }
        } elseif ($method === 'post') {
            self::$route[$method][$rule] = $route;
        }


    }
}