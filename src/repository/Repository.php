<?php

require_once __DIR__.'/../../Database.php';

class Repository
{
    protected $database;

    private static $instance;


    protected function __construct()
    {
        $this->database = Database::getInstance();
    }
    protected function __clone() {}
    protected function __wakeup() {}

    public static function getInstance() {
        if(!isset(static::$instance))
            static::$instance = new static();
        return static::$instance;
    }
}