<?php

namespace snoweddy\src\db;

use PDO;

class DBDome extends PDO
{
    public function __construct($dsn, $user, $pass)
    {
        parent::__construct($dsn, $user, $pass);
    }
}