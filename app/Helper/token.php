<?php

namespace App\Helper;
use Firebase\JWT\JWT;

class Token
{
    private $key;
    private $data;
    private $algorithm;

    public function __construct ($data = null)
    {
        $this->key = 'asjfknkewjfDjd.,snf';
        $this->data = $data;
        $this->algorithm = array('HS256');
    }

    public function encode()
    {
        return JWT::encode($this->data, $this->key);
    }

    public function decode($token)
    {
        return JWT::decode($token, $this->key, $this->algorithm);
    }
}