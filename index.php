<?php

require 'vendor/autoload.php';
require_once "./autoload.php";

$request = $_SERVER['REQUEST_URI'];

$request = ltrim($request, '/');

switch (true) {
    case ($request === ''):
        Route::resource(UserController::class, 'index');
        break;

    case ($request === 'login'):
        Route::resource(UserController::class, 'create');
        break;

    case preg_match('/^user\/(\d+)$/', $request, $matches):
        $id = $matches[1];
        echo "ID capturado: $id";
        break;

    default:
        echo "Página não encontrada.";
        break;
}
