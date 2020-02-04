<?php

namespace snoweddy\src\library;

class Response
{
    public function __construct()
    {

    }
    public function json(array $data, $statusCode = 200)
    {
        http_response_code($statusCode);
        return json_encode($data);
    }
}