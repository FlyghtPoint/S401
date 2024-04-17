<?php
// router.php
class Router {
    private $routes = [];

    public function addRoute($method, $url, $handler) {
        $this->routes[] = [$method, $url, $handler];
    }

    public function dispatch($method, $url) {
        try {
            if ($method === 'OPTIONS') {
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
                header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
                http_response_code(200);
                error_log('Handled OPTIONS request');
                exit;
            }
    
            foreach ($this->routes as $route) {
                list($routeMethod, $routeUrl, $handler) = $route;
                if ($method === $routeMethod) {
                    if (preg_match('#^' . $routeUrl . '$#', $url, $matches)) {
                        call_user_func($handler, $matches);
                        return;
                    }
                }
            }
            // If no route is found
            header('HTTP/1.0 404 Not Found');
            echo '404 - Not Found';
        } catch (\Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }   
    }
}
?>