<?php

namespace snoweddy\src\db;

use PDO;
use PDOException;

class DB
{
    /*
     * 初始化默认属性
     */
    protected static $_instance = null;
    protected $dbh;
    protected $dsn;

    private function __construct()
    {
        $dbConfig = config('config.db');
        $this->dsn = sprintf(
            '%s:host=%s;dbname=%s;charset=utf8;',
            $dbConfig['connection'],
            $dbConfig['host'],
            $dbConfig['dbname'],
        );
        $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
        return $this->dbh = new PDO($this->dsn, $dbConfig['user'], $dbConfig['pass'], $options);
    }

    /*
     * 单例入口
     */
    public static function init()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /*
     * 执行一条sql返回影响函数
     */
    public function exec($sql)
    {
        return $this->dbh->exec($sql);
    }

    /*
     * 执行一条sql返回结果集
     */
    public function query($sql)
    {
        $rule = $this->dbh->query($sql);
    }

    /*
     * 禁止克隆
     */
    private function __clone() {}
}