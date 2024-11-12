<?php

class Route {
    public static function resource($controller, $method, $request = [])
    {
        $instance = new $controller;
        return $instance->$method($request);
    }
}
