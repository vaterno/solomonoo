<?php

use Lib\Router;
use App\Controllers\TreeController;
use App\Controllers\IndexController;
use App\Controllers\Api\ProductController;

/** @var $router Router */

$router->add('/', IndexController::class, 'index');
$router->add('/api/products', ProductController::class, 'index');
$router->add('/api/products/show', ProductController::class, 'show');

$router->add('/tree', TreeController::class, 'index');
