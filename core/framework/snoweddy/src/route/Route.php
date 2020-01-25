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
        // 获取url地址并去除两边'/'
        $url = trim($_SERVER['REQUEST_URI'], '/');

        // 去除url多余字符
        $position = strpos($url, '.');
        if ($position !== false) {
            $url = substr($url, 0, $position);
        }
        $position = strpos($url, '?');
        if ($position !== false) {
            $url = substr($url, 0, $position);
        }

        // 判断url是不是控
        $url = $url ? $url : '/';

        // 初始化属性
        $controller = '';
        $action = '';
        $params = [];
        $dispatch = null;
        $route = null;

        // 判断get还是post请求
        if ($method === 'get') {
            // 获取预定义的路由组
            $getArray = self::$route['get'];

            // 判断当前路由有没有传递参数，若有参数直接找到对应参数返回
            if (array_key_exists($url, $getArray['no_params'])) {
                $route = $getArray['no_params'][$url];

                /// else里面是带有参数的路由，调用静态方法parsing处理后返回路由与参数
            } else {
                $result = self::parsing($url, $getArray['have_params']);
                $route = $result['route'];
                $params = $result['params'];
            }
            // 若是post请求，在route数组内找到对应的键值对
        } elseif ($method === 'post') {
            $postArray = self::$route['post'];
            $route = $postArray[$url];
        }

        // 判断路由调用的是控制器还是回调函数
        if (is_string($route)) {
            $route = explode('@', $route);
            // 调用回调函数
        } elseif (is_object($route)) {
            return print_r(call_user_func_array($route, $params));
        }

        // 设置默认控制器命名空间
        $controller = 'app\\http\\controllers\\' . array_shift($route);
        // 实例化类
        $dispatch = new $controller();
        // 调用类方法
        return print_r(call_user_func_array([$dispatch, $route[0]], $params));
    }

    /*
     * 处理uri
     * 1）$url 拆分url
     * 2）便利have_params找到与url相似的键值对
     * @route 当前访问的url
     * @data  所有路由数组
     */
    private static function parsing($route, $data)
    {
        // 初始化变量放置参数
        $params = [];

        // 拆分url便于在数组当中查找，并且获取数组长度
        $route = explode('/', $route);
        $routeLength = count($route);

        // 便利所有路由比对
        foreach ($data as $key => $var) {

            // 出去路由前后多余字符
            $key = trim($key, '/');

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
        $rule = trim($params[0], '/');
        $rule = $rule ? $rule : '/';
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