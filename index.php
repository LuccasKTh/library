<?php

require 'vendor/autoload.php';
require_once "./autoload.php";

$request = $_SERVER['REQUEST_URI'];

$request = ltrim($request, '/');

switch (true) {
    case ($request === 'login'):
        Route::resource(UserController::class, 'create');
        break;

    case ($request === 'customer'):
        Route::resource(UserController::class, 'index');
        break;

    case preg_match('/^customer\/(\d+)$/', $request, $matches):
        $id = $matches[1];
        Route::resource(UserController::class, 'show');
        break;

    case ($request === 'author'):
        Route::resource(AuthorController::class, 'index');
        break;

    case preg_match('/^author\/(\d+)$/', $request, $matches):
        $id = $matches[1];
        Route::resource(AuthorController::class, 'show');
        break;

    case ($request === 'category'):
        Route::resource(CategoryController::class, 'index');
        break;

    case preg_match('/^category\/(\d+)$/', $request, $matches):
        $id = $matches[1];
        Route::resource(CategoryController::class, 'show');
        break;

    case ($request === 'book'):
        Route::resource(BookController::class, 'index');
        break;

    case preg_match('/^book\/(\d+)$/', $request, $matches):
        $id = $matches[1];
        Route::resource(BookController::class, 'show');
        break;

    default:
        echo "Página não encontrada.";
        break;
}
