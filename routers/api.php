<?php
require_once __DIR__. '/../controllers/AuthControllers.php';
require_once __DIR__. '/../controllers/UserControllers.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($uri == '/login' && $method == 'POST') {
    AuthController::login();
} elseif ($uri == '/register' && $method == 'POST') {
    AuthController::register();
} elseif ($uri == '/users' && $method == 'GET') {
    UserControllers::index();
} elseif (preg_match('#^/users/(\d+)$#',$uri , $matches) && $method == 'GET') {
    UserControllers::getUser($matches[1]);
} elseif ($uri == '/users' && $method == 'POST') {
    UserControllers::create();
} elseif (preg_match('#^/users/(\d+)$#',$uri , $matches) && $method == 'PUT') {
    UserControllers::update($matches[1]);
} elseif (preg_match('#^/users/(\d+)$#',$uri , $matches) && $method == 'DELETE') {
    UserControllers::delete($matches[1]);
} else {
    http_response_code(404);
    echo json_encode(['status'=>false, 'error' => 'Route not found']);
}