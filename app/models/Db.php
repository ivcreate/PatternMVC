<?php
abstract class Db{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host='.getenv("DB_HOST").';dbname='.getenv("DB_NAME"), getenv("DB_LOGIN"), getenv("DB_PASSWORD"));
    }

    public function __destruct(){
        $this->db = null;
    }
}
