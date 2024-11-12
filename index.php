<?php

require 'vendor/autoload.php';
require_once "./autoload.php";

$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$request = $_GET ? $_GET : $_POST;

$route = ltrim($route, '/');

switch (true) {
    case ($route === ''):
        header('location: /customer');
        break;

    case ($route === 'index.php'):
        header('location: /customer');
        break;

    case ($route === 'login'):
        Route::resource(CustomerController::class, 'create');
        break;

    case ($route === 'customer'):
        Route::resource(CustomerController::class, 'index');
        break;

    case ($route === 'customer/create'):
        Route::resource(CustomerController::class, 'create');
        break;

    case preg_match('/^customer\/(\d+)$/', $route, $matches):
        $id = $matches[1];
        Route::resource(CustomerController::class, 'show');
        break;

    case ($route === 'author' && $method === 'GET'):
        Route::resource(AuthorController::class, 'index');
        break;

    case ($route === 'author/create' && $method === 'GET'):
        Route::resource(AuthorController::class, 'create');
        break;

    case ($route === 'author' && $method === 'POST'):
        Route::resource(AuthorController::class, 'store', $request);
        break;

    case preg_match('/^author\/(\d+)$/', $route, $matches):
        $id = $matches[1];
        Route::resource(AuthorController::class, 'show');
        break;

    case ($route === 'category'):
        Route::resource(CategoryController::class, 'index');
        break;

    case preg_match('/^category\/(\d+)$/', $route, $matches):
        $id = $matches[1];
        Route::resource(CategoryController::class, 'show');
        break;

    case ($route === 'book'):
        Route::resource(BookController::class, 'index');
        break;

    case preg_match('/^book\/(\d+)$/', $route, $matches):
        $id = $matches[1];
        Route::resource(BookController::class, 'show');
        break;

    default:
        echo "Página não encontrada.";
        break;
}
