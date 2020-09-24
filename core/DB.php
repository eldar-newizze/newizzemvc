<?php

namespace Core;

use PDO;
use PDOException;

class DB
{
    private static $connection = null;

    public static function connect()
    {
        if (is_null(self::$connection)) {
            self::$connection = self::getData();
        }
        return self::$connection;
    }

    private static function getData()
    {
        echo 'df';
        $host = env('DB_HOST');
        $db   = env('DB_DATABASE');
        $user = env('DB_USERNAME');
        $pass = env('DB_PASSWORD');
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            return new PDO($dsn, $user, $pass, $opt);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }
}
