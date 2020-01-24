<?php

namespace app\http\models;

use snoweddy\src\base\Model;

class User extends Model
{
    /*
     * 初始化属性
     */
    protected $table = 'users';

    /*
     * 添加用户
     */
    public function add_user(array $array)
    {
        $sql = sprintf(
            "insert into `%s` (name, username, password, email, phone) values ('%s', '%s', '%s', '%s', '%s')",
            $this->table,
            $array['name'],
            $array['username'],
            $array['password'],
            $array['email'],
            $array['phone']
        );
        return $this->db->exec($sql);
    }
}