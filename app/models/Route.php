<?php

class Route {
    public static function resource($controller, $method)
    {
        $instance = new $controller;
        return $instance->$method();
    }
}
