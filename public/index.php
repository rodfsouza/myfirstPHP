<?php
session_start();

require_once '../config/config.php';
require_once '../config/database.php';
require_once '../src/Controllers/AuthController.php';
require_once '../src/Controllers/HomeController.php';
require_once '../src/Controllers/TaskController.php';

$request = $_SERVER['REQUEST_URI'];
$base = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
$request = str_replace($base, '', $request);

$routes = [
    '/' => ['HomeController', 'index'],
    '/login' => ['AuthController', 'login'],
    '/register' => ['AuthController', 'register'],
    '/logout' => ['AuthController', 'logout'],
    '/tasks' => ['TaskController', 'index'],
    '/tasks/create' => ['TaskController', 'create'],
    '/tasks/edit' => ['TaskController', 'edit'],
    '/tasks/delete' => ['TaskController', 'delete'],
];

if (array_key_exists($request, $routes)) {
    [$controller, $method] = $routes[$request];
    $controller = new $controller();
    $controller->$method();
} else {
    http_response_code(404);
    require '../src/Views/404.php';
}
?>