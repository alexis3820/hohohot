<?php

class DB extends PDO
{
    private static $instance;

    const S_hostname = "localhost";
    const S_dbname = "hothothot";
    const S_username = "root";
    const S_password = "";

    public function __construct(){
        $_dsn = 'mysql:dbname='. self::S_dbname . ';host=' . self::S_hostname;
        try {
            parent::__construct($_dsn, self::S_username, self::S_password);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            //key value
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            //show error
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public static function getInstance(){
        if(null === self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }
}