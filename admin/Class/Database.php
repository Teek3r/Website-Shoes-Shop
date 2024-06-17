<?php
class Database
{
    public $host = "localhost";
    public $user = "admin_shoes";
    public $password = "thien12345";
    public $db = "shoesshop";
    public static function getConnect($host, $mydb, $user, $password)
    {
        $dsn = "mysql:host=$host;dbname=$mydb;charset=utf8";
        try {
            $pdo = new PDO($dsn, $user, $password);
            return $pdo;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}