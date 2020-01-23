<?php

namespace snoweddy\src\base;


use snoweddy\src\db\DB;

class Model
{
    /*
     * 初始化属性
     */
    protected $model;
    protected $table;
    protected $primary = 'id';
    protected $db;


    public function __construct()
    {
        if ($this->table) {
            $this->model = substr(strrchr(get_class($this), '\\'), 1);
            $this->table = strtolower($this->model) . 's';
        }
        $this->db = DB::init();
    }
}