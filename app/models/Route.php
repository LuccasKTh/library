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

    public static function makeUri($uri)
    {
        return str_replace("/",".", $uri);
    }

    public static function getRequest()
    {
        return $_REQUEST;
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

    public static function controller($controller, $method, $request = [])
    {
        $route = Route::makeCleanUri();
        switch (true) {
            case ($route === 'book' && $method === 'GET'):
                Route::resource(BookController::class, 'index');
                break;
        
            case ($route === 'book/create' && $method === 'GET'):
                Route::resource(BookController::class, 'create');
                break;
                
            case ($route === 'book' && $method === 'POST'):
                Route::resource(BookController::class, 'store', $request);
                break;
        
            case preg_match('/^book\/(\d+)$/', $route, $matches):
                $id = $matches[1];
                Route::resource(BookController::class, 'show', $id);
                break;
        
            case preg_match('/^book\/(\d+)\/edit$/', $route, $matches):
                $id = $matches[1];
                Route::resource(BookController::class,'edit', $id);
                break;
        
            case ($route === 'book/update' && $method === 'POST'):
                Route::resource(BookController::class,'update', $request);
                break;
        
            case preg_match('/^book\/(\d+)\/destroy$/', $route, $matches):
                $id = $matches[1];
                Route::resource(BookController::class,'destroy', $id);
                break;
        }
    }

    public static function get(string $url, array $params)
    {
        $currentUri = self::makeCleanUri();
        $currentUri = self::makeUri($currentUri);
        if (self::getMethod() === 'GET' && $currentUri === $url) {
            $controller = $params[0];
            $method = $params[1];
            return $controller->$method();
        }
    }
}
