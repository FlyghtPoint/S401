<?php
// router.php
class Router {
    private $routes = [];

    public function addRoute($method, $url, $handler) {
        $this->routes[] = [$method, $url, $handler];
    }

    public function dispatch($method, $url) {
        foreach ($this->routes as $route) {
            list($routeMethod, $routeUrl, $handler) = $route;
            if ($method === $routeMethod && $url === $routeUrl) {
                call_user_func($handler);
                return;
            }
        }
        // If no route is found
        header('HTTP/1.0 404 Not Found');
        echo '404 - Not Found';
    }
}
?>