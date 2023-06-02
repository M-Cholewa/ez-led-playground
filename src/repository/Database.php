<?php

// require_once "config.php";

namespace repository;
use PDO;
use PDOException;

class Database
{
    private string $username;
    private string $password;
    private string $host;
    private string $database;
    private static self $instance;

    private function __construct()
    {
    }

    public static function getInstance(): Database
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
            self::$instance->username = 'dbuser';
            self::$instance->password = 'dbpwd';
            self::$instance->host = 'db';
            self::$instance->database = 'dbname';
        }
        return self::$instance;
    }

    public function connect()
    {
        try {
            $conn = new PDO(
                "pgsql:host=$this->host;port=5432;dbname=$this->database",
                $this->username,
                $this->password,
                ["sslmode" => "prefer"]
            );

            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}