<?php

namespace App\Database;

use \Exception;

class Connection
{
    public static function make($config)
    {
        try {
            $dsn = $config['connection'] . ';dbname=' . $config['dbname'];
            // var_dump($config);
            // die;

            return new \PDO(
                $dsn,
                $config['dbuser'],
                $config['dbpassword'],
                $config['options']
            );
        } catch (\PDOException $e) {
            // die($e->getMessage());
            throw new \PDOException($e->getMessage());
        }
    }
}
