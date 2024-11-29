<?php

class Route 
{
    public static function getUri()
    {
        return $_SERVER["REQUEST_URI"];
    }

    public static function getMethod()
    {
        return $_SERVER["REQUEST_METHOD"];
    }

    public static function makeCleanUri()
    {
        return ltrim(self::getUri(), '/');
    }

    public static function uriMethodController()
    {
        $result = explode('/', self::makeCleanUri());
        return array_pop($result);
    }

    public static function uriModel()
    {
        $result = explode('/', self::makeCleanUri());
        return $result[0];
    }

    public static function resource($controller, $method, $request = [])
    {
        $instance = new $controller;
        return $instance->$method($request);
    }
}
