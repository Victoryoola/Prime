<?php

class Router
{
    private array $routes = [];

    public function get(string $path, string $action): void
    {
        $this->routes['GET'][$path] = $action;
    }

    public function post(string $path, string $action): void
    {
        $this->routes['POST'][$path] = $action;
    }

    public function dispatch(string $method, string $path): void
    {
        if (!isset($this->routes[$method][$path])) {
            http_response_code(404);
            echo "404 - Page Not Found";
            return;
        }

        $action = $this->routes[$method][$path];
        [$controllerName, $methodName] = explode('@', $action);

        $controller = new $controllerName();
        $controller->$methodName();
    }
}
