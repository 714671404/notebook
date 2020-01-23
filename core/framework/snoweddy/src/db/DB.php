<?php

namespace snoweddy\src\db;

use PDO;
use PDOException;

class DB
{
    /*
     * 初始化常用属性
     */
    protected static $pdo = null;

    public static function pdo()
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        try {
            $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', DB_HOST, DB_name);
            $option = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
            return self::$pdo = new PDO($dsn, DB_USER, DB_PASS, $option);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
}