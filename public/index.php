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
$router->add('admin/users/sua-thong-tin/{id:\d+}', ['namespace' => 'Admin', 'controller' => 'UserMngr', 'action' => 'update']);
$router->add('admin/users/them-moi', ['namespace' => 'Admin', 'controller' => 'UserMngr', 'action' => 'insert']);

$router->add('admin/books', ['namespace' => 'Admin', 'controller' => 'BooksMngr', 'action' => 'index']);
$router->add('admin/books/them-moi', ['namespace' => 'Admin', 'controller' => 'BooksMngr', 'action' => 'insert']);
$router->add('admin/books/cap-nhat/{id:\d+}', ['namespace' => 'Admin', 'controller' => 'BooksMngr', 'action' => 'update']);

$router->add('admin/authors', ['namespace' => 'Admin', 'controller' => 'AuthorMngr', 'action' => 'index']);
$router->add('admin/authors/them-moi', ['namespace' => 'Admin', 'controller' => 'AuthorMngr', 'action' => 'insert']);
$router->add('admin/authors/cap-nhat/{id:\d+}', ['namespace' => 'Admin', 'controller' => 'AuthorMngr', 'action' => 'update']);

$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

$router->dispatch($_SERVER['QUERY_STRING']);
