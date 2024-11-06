<?php

use Dotenv\Dotenv;

class Database 
{
    public static function getInstance()
    {
        try {
            $env = self::getEnv();
            $dns = self::makeDNS($env);
            return new PDO($dns, $env['DB_USER'], $env['DB_PASSWORD']);
        } catch (PDOException $e) {
            echo "Database connection error. (".$e->getMessage().")";
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

}