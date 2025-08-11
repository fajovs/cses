<?php

session_start();



const BASE_PATH = __DIR__ . '/';
const BASE_URL = '/ccses';

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
            header('Location: '. base_url('/admin/programs'));
            exit;
        case 'student':
            header('Location: ' . base_url('/student/subjects'));
            exit;
        case 'faculty':
            header('Location: ' . base_url('/faculty/subjects'));
            exit;
        case 'parent':
            header('Location: ' . base_url('/parent/students'));
            exit;
    }
}


$router->route($uri, $method);
