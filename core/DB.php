<?php

namespace Core;

use RedBeanPHP\R;

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
        $host = env('DB_HOST');
        $db   = env('DB_DATABASE');
        $user = env('DB_USERNAME');
        $pass = env('DB_PASSWORD');
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        return R::setup( $dsn, $user, $pass );
    }
}
