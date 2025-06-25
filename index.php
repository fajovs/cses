<?php

session_start();



const BASE_PATH = __DIR__ . '/';
const BASE_URL = '/CSES';

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function($class){
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require base_path("{$class}.php");
});

$router = new Core\Router;
$routes = require base_path('routes.php');


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];



if ($uri === base_url('/') && isset($_SESSION['role'])) {
    
    switch ($_SESSION['role']) {
        case 'admin':
            header('Location: '. base_url('/admin/dashboard'));
            exit;
        case 'student':
            header('Location: ' . base_url('/student/dashboard'));
            exit;
        case 'faculty':
            header('Location: ' . base_url('/faculty/dashboard'));
            exit;
        case 'parent':
            header('Location: ' . base_url('/parent/dashboard'));
            exit;
    }
}


$router->route($uri, $method);
