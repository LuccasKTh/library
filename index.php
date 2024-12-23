<?php

require 'vendor/autoload.php';
require_once "./autoload.php";

$route = Route::makeCleanUri();
$method = Route::getMethod();
$request = Route::getRequest();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

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

    case ($route === 'customer' && $method === 'GET'):
        Route::resource(CustomerController::class, 'index');
        break;

    case ($route === 'customer/create'):
        Route::resource(CustomerController::class, 'create');
        break;

    case ($route === 'customer' && $method === 'POST'):
        Route::resource(CustomerController::class, 'store', $request);
        break;

    case preg_match('/^customer\/(\d+)$/', $route, $matches):
        $id = $matches[1];
        Route::resource(CustomerController::class, 'show', $id);
        break;

    case preg_match('/^customer\/(\d+)\/edit$/', $route, $matches):
        $id = $matches[1];
        Route::resource(CustomerController::class,'edit', $id);
        break;

    case ($route === 'customer/update' && $method === 'POST'):
        Route::resource(CustomerController::class,'update', $request);
        break;

    case preg_match('/^customer\/(\d+)\/destroy$/', $route, $matches):
        $id = $matches[1];
        Route::resource(CustomerController::class,'destroy', $id);
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
        Route::resource(AuthorController::class, 'show', $id);
        break;

    case preg_match('/^author\/(\d+)\/edit$/', $route, $matches):
        $id = $matches[1];
        Route::resource(AuthorController::class,'edit', $id);
        break;

    case ($route === 'author/update' && $method === 'POST'):
        Route::resource(AuthorController::class,'update', $request);
        break;

    case preg_match('/^author\/(\d+)\/destroy$/', $route, $matches):
        $id = $matches[1];
        Route::resource(AuthorController::class,'destroy', $id);
        break;

    case ($route === 'category' && $method === 'GET'):
        Route::resource(CategoryController::class, 'index');
        break;

    case ($route === 'category/create' && $method === 'GET'):
        Route::resource(CategoryController::class, 'create');
        break;

    case ($route === 'category' && $method === 'POST'):
        Route::resource(CategoryController::class, 'store', $request);
        break;

    case preg_match('/^category\/(\d+)$/', $route, $matches):
        $id = $matches[1];
        Route::resource(CategoryController::class, 'show', $id);
        break;

    case preg_match('/^category\/(\d+)\/edit$/', $route, $matches):
        $id = $matches[1];
        Route::resource(CategoryController::class,'edit', $id);
        break;

    case ($route === 'category/update' && $method === 'POST'):
        Route::resource(CategoryController::class,'update', $request);
        break;

    case preg_match('/^category\/(\d+)\/destroy$/', $route, $matches):
        $id = $matches[1];
        Route::resource(CategoryController::class,'destroy', $id);
        break;

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

    default:
        echo "Página não encontrada.";
        break;
}
