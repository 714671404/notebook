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
                if (isset($getArray['have_params'])) {
                    $result = self::parsing($url, $getArray['have_params']);
                    $route = $result['route'];
                    $params = $result['params'];
                } else {
                    $route = false;
                }
            }
            // 若是post请求，在route数组内找到对应的键值对
        } elseif ($method === 'post') {
            $postArray = self::$route['post'];
            $route = $postArray[$url];
        }
        if (!$route) {
            exit('<h1 style="color:red">当前路由并不存在</h1>');
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

            // 除去路由前后多余字符
            $key = trim($key, '/');

            // 拆分路由
            $rule = explode('/', $key);
            // 获取路由长度
            $ruleLength = count($rule);
            // 对比若不相等直接停止当前循环
            if ($routeLength !== $ruleLength) {
                continue;
            }

            // 遍历路由
            foreach ($rule as $k => $v) {

                // 若数组与url当前位相同路由长度减一终止当前一次循环
                if ($v === $route[$k]) {
                    $ruleLength --;
                    continue;

                    // 正则匹配若当前路由值符合参数要求路由长度减一终止当前一次循环，并且将参数放到$params数组当中
                } else if (preg_match('/^\{\w+\}/i', $v)) {
                    $params[] = $route[$k];
                    $ruleLength --;
                    continue;
                }
            }

            // 路由长度等于0代表匹配到对应路由终止循环
            if ($ruleLength === 0) {
                $route = $var;
                break;
            }
        }

        // 返回路由与参数
        return [
            'route' => $route,
            'params' => $params
        ];
    }

    public static function __callStatic($method, $params)
    {
        // 清除路由多余字符
        $rule = trim($params[0], '/');
        $rule = $rule ? $rule : '/';
        $route = $params[1];

        // 判断是get请求或者post请求
        if ($method === 'get') {

            // 按照要处理数组
            if ((strpos($rule, '{') === false) && (strpos($rule, '}') === false)) {
                // 没有参数的路由
                self::$route[$method]['no_params'][$rule] = $route;
            } else {
                // 有参数的路由
                self::$route[$method]['have_params'][$rule] = $route;;
            }
        } elseif ($method === 'post') {
            // post都是没有参数路由
            self::$route[$method][$rule] = $route;
        }


    }
}