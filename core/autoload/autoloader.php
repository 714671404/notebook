<?php

class Autoloader
{
    /*
     * 自动加载
     */
    public static function loadClass($className)
    {
        // 系统核心文件加载
        $classMap = self::classMap();
        if (isset($classMap[$className])) {
            $file = $classMap[$className];
        } else {
            $file = APP_PATH . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        }

        includePath($file);
    }

    public static function getLoader()
    {
        spl_autoload_register(['Autoloader', 'loadClass']);
    }

    /*
    * 核心文件地址
    */
    private static function classMap()
    {
        return [
            'snoweddy\\src\\App' => APP_PATH . '/core/framework/snoweddy/src/App.php',
            'snoweddy\\src\\base\\Controller' => APP_PATH . '/core/framework/snoweddy/src/base/Controller.php',
            'snoweddy\\src\\base\\Model' => APP_PATH . '/core/framework/snoweddy/src/base/Model.php',
            'snoweddy\\src\\base\\View' => APP_PATH . '/core/framework/snoweddy/src/base/View.php',
            'snoweddy\\src\\base\\Env' => APP_PATH . '/core/framework/snoweddy/src/base/Env.php',
            'snoweddy\\src\\db\\Sql' => APP_PATH . '/core/framework/snoweddy/src/db/Sql.php',
            'snoweddy\\src\\db\\DB' => APP_PATH . '/core/framework/snoweddy/src/db/DB.php',
            'snoweddy\\src\\db\\DBDome' => APP_PATH . '/core/framework/snoweddy/src/db/DBDome.php',
            'snoweddy\\src\\route\\Route' => APP_PATH . '/core/framework/snoweddy/src/route/Route.php',
        ];
    }
}

function includePath($file)
{
    include $file;
}