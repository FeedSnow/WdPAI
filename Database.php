<?php

require_once 'config.php';

class Database
{
    private $username;
    private $password;
    private $host;
    private $database;
    private $port;

    private static $instance;

    private function __construct()
    {
        $this->username = USERNAME;
        $this->password = PASSWORD;
        $this->host = HOST;
        $this->database = DATABASE;
        $this->port = PORT;
    }
    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance() {
        if(!isset(static::$instance))
            static::$instance = new static();
        return static::$instance;
    }

    public function connect($multi_stmt = false)
    {
        try {
            $conn = new PDO(
                "pgsql:host=$this->host;port=$this->port;dbname=$this->database",
                $this->username,
                $this->password,
                ['sslmode' => 'prefer']
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, $multi_stmt ? 1 : 0);
            return $conn;
        } catch(PDOException $e) {
            die("Connection failed: ".$e->getMessage());
        }
    }
}