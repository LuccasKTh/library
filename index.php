<?php

require_once "./autoload.php";

$request = $_SERVER['REQUEST_URI'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

switch ($request) {
    case '/':
        Route::resource(UserController::class, 'index');
        break;

    case '/login':
        Route::resource(UserController::class, 'create');
        break;

    case '/register':
        $instance = new UserController;
        $instance->index(); 
        break;
}
