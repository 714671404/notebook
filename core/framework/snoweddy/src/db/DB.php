<?php

namespace snoweddy\src\db;

use PDO;
use PDOException;

class DB
{
    /*
     * 初始化属性
     */
    private static $_instance = null;
    private $host;
    private $user;
    private $pass;
    private $dbname;
    private $charset;
    private $port;
    private $connection;

    /*
     * 禁止实例
     */
    private function __construct() {
        try {
            $this->setInfo();
            $dsn = sprintf(
                '%s:host=%s;dbname=%s;charset=utf8;port=%s',
                $this->connection,
                $this->host,
                $this->dbname,
                $this->port
            );
            $option = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
            return new PDO($dsn, $this->user, $this->pass, $option);
        } catch (PDOException $e) {
            exit("错误信息：" . $e->getMessage());
        }
    }

    /*
     * 实例入口
     */
    public static function init()
    {
        /*
         * 单例实例化
         */
        if (null !== self::$_instance) {
            return self::$_instance;
        }

        return self::$_instance = new self();
    }

    /*
     * 加载数据库信息
     */
    private function setInfo()
    {
        $dbConfig = config('config.db');
        $this->host = $dbConfig['host'];
        $this->user = $dbConfig['user'];
        $this->pass = $dbConfig['pass'];
        $this->dbname = $dbConfig['dbname'];
        $this->port = $dbConfig['port'];
        $this->connection = $dbConfig['connection'];
    }

    /*
     * 禁止克隆
     */
    private function __clone() {}
}