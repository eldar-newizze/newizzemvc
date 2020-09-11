<?php


namespace Core;

class Model extends DB
{
    private static $pdo;

    protected static function queryTable($sql)
    {
        self::$pdo = DB::connect();
        $data = self::$pdo->query($sql)->fetchAll();
        return $data ?? null;
    }
}
