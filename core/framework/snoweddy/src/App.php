<?php

namespace snoweddy\src;

use snoweddy\src\base\Env;
use snoweddy\src\route\Route;

class App
{
    /*
     * 初始化属性
     * @var array
     */
    private $config = [];

    public function __construct()
    {
        $this->config = Env::config('config');
    }

    /*
     * 加载程序
     */
    public function run()
    {
        $this->http();
    }

    public function http()
    {
        header("Content-type:text/html;charset=utf-8");
        $this->setReporting();
        $this->removeMagicQuotes();
        $this->unregisterGlobals();
        $this->init();
        Route::init();
    }


    /*
     * 检测开发环境
     */
    public function setReporting()
    {
        if ($this->config['debug'] === true) {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
        }
    }

    // 删除敏感字符
    public function stripSlashesDeep($value)
    {
        $value = is_array($value) ? array_map(array($this, 'stripSlashesDeep'), $value) : stripslashes($value);
        return $value;
    }

    // 检测敏感字符并删除
    public function removeMagicQuotes()
    {
        if (get_magic_quotes_gpc()) {
            $_GET = isset($_GET) ? $this->stripSlashesDeep($_GET ) : '';
            $_POST = isset($_POST) ? $this->stripSlashesDeep($_POST ) : '';
            $_COOKIE = isset($_COOKIE) ? $this->stripSlashesDeep($_COOKIE) : '';
            $_SESSION = isset($_SESSION) ? $this->stripSlashesDeep($_SESSION) : '';
            $_REQUEST = isset($_REQUEST) ? $this->stripSlashesDeep($_REQUEST) : '';
            $_SERVER = isset($_SERVER) ? $this->stripSlashesDeep($_SERVER) : '';
        }
    }

    // 检测自定义全局变量并移除。因为 register_globals 已经弃用，如果
    // 已经弃用的 register_globals 指令被设置为 on，那么局部变量也将
    // 在脚本的全局作用域中可用。 例如， $_POST['foo'] 也将以 $foo 的
    // 形式存在，这样写是不好的实现，会影响代码中的其他变量。 相关信息，
    // 参考: http://php.net/manual/zh/faq.using.php#faq.register-globals
    public function unregisterGlobals()
    {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }

    /*
     * 初始化
     */
    public function init()
    {
         include_once __DIR__ . '/library/function.php';
    }
}