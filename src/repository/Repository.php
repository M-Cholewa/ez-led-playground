<?php


use repository\Database;

require_once 'Database.php';

class Repository {
    protected Database $database;
    public function __construct()
    {
        $this->database = Database::getInstance();
    }
}