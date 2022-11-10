<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
// config variable route
$router->add('sach/{id:\d+}', ['controller' => 'Book', 'action' => 'index']);
$router->add('danh-sach/{type:\w+}/{id:\w+}', ['controller' => 'ListBook', 'action' => 'index']);

$router->add('login', ['controller' => 'Authen', 'action' => 'login']);

$router->add('admin', ['namespace' => 'Admin', 'controller' => 'DashBoard', 'action' => 'index']);
$router->add('admin/users', ['namespace' => 'Admin', 'controller' => 'UserMngr', 'action' => 'index']);
$router->add('admin/users/sua-thong-tin', ['namespace' => 'Admin', 'controller' => 'UserMngr', 'action' => 'update']);
$router->add('admin/users/them-moi', ['namespace' => 'Admin', 'controller' => 'UserMngr', 'action' => 'insert']);
$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

$router->dispatch($_SERVER['QUERY_STRING']);
