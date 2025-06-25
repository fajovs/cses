<?php

namespace Core;

class Router
{
    protected $routes = [];

    public function add($uri, $controller, $method, $roles)
    {

        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'roles' => $roles
        ];
    }

    public function get($uri, $controller , $roles)
    {

        $this->add($uri, $controller, 'GET', $roles);
    }

    public function post($uri, $controller , $roles)
    {

        $this->add($uri, $controller, 'POST' , $roles);
    }

    public function delete($uri, $controller , $roles)
    {

        $this->add($uri, $controller, 'DELETE' , $roles);
    }

    public function patch($uri, $controller , $roles)
    {
        $this->add($uri, $controller, 'PATCH' , $roles);
    }

    public function put($uri, $controller , $roles)
    {

        $this->add($uri, $controller, 'PUT' , $roles);
    }

    public function route($uri, $method)
{
    foreach ($this->routes as $route) {
        if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {

            // Check if this route has role restrictions
            if (!empty($route['roles'])) {
                $userRole = $_SESSION['role'] ?? null;

                if (!in_array($userRole, $route['roles'])) {
                    $this->abort(403); // Forbidden
                }
            }

            return require base_path($route['controller']);
        }
    }

    $this->abort(); // Not found
}
    protected function abort($code = 404)
    {
        http_response_code($code);

        require("views/$code.view.php");

        die();
    }
}
