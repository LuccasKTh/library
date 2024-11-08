<?php

use Dotenv\Dotenv;

class Database 
{
    public static function getInstance()
    {
        try {
            $env = self::getEnv();
            $dns = self::makeDNS($env);;
            return new PDO($dns, $env['DB_USER'], $env['DB_PASSWORD']);
        } catch (PDOException $e) {
            echo "Database connection error. ({$e->getMessage()})";
        }    
    }

    public static function getEnv()
    {
        $dotenv = Dotenv::createImmutable(getcwd());
        return $dotenv->load();    
    }

    public static function makeDNS($env)
    {
        return 'mysql:host='.$env['DB_HOST'].';port='.$env['DB_PORT'].';dbname='.$env['DB_DATABASE'].';charset=UTF8';
    }

    public static function connect()
    {
        return Database::getInstance();
    }

    public static function prepare($connection, $sql)
    {
        return $connection->prepare($sql);    
    }

    public static function bind($command, $params = [])
    {
        foreach ($params as $key => $value) {
            $command->bindValue($key, $value);
        }

        return $command;
    }

    public static function execute($sql, $params = [])
    {
        $connection = self::connect();
        $command = self::prepare($connection, $sql);
        $command = self::bind($command, $params);

        try {
            $command->execute();
            return $command;
        } catch (PDOException $e) {
            throw new Exception("Execute command error in database. ({$e->getMessage()}. - {$command->errorInfo()[2]})");
        }
    }

    

}