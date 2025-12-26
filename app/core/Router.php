<?php
class Router
{
    private static $routes = [];
    private static $currentRoute = null;

    public static function get($page, $controller, $method)
    {
        self::$currentRoute = $page;
        self::$routes[$page] = [
            'controller' => $controller,
            'method' => $method,
            'middlewares' => []
        ];

        // ini biar chaining katanya
        return new static();
    }

    public function middleware($middlewares)
    {
        if (self::$currentRoute !== null) {
            $middlewares = is_array($middlewares) ? $middlewares : [$middlewares];
            self::$routes[self::$currentRoute]['middlewares'] = $middlewares;
        }
        return $this;
    }

    public static function dispatch()
    {
        $page = $_GET['page'] ?? 'login';

        // Debug mode (uncomment jika perlu)
        // echo "Current page: $page<br>";
        // echo "Available routes: <pre>";
        // print_r(array_keys(self::$routes));
        // echo "</pre>";

        if (isset(self::$routes[$page])) {
            $route = self::$routes[$page];

            // Run middlewares
            foreach ($route['middlewares'] as $middleware) {
                if (!class_exists($middleware)) {
                    die("Middleware {$middleware} not found!");
                }

                $middlewareInstance = new $middleware();
                if (!$middlewareInstance->handle()) {
                    return; // Middleware failed
                }
            }

            // Run controller
            if (!class_exists($route['controller'])) {
                die("Controller {$route['controller']} not found!");
            }

            $controller = new $route['controller']();
            $method = $route['method'];

            if (!method_exists($controller, $method)) {
                die("Method {$method} not found in {$route['controller']}!");
            }

            $controller->$method();
        } else {
            self::handleNotFound();
        }
    }

    private static function handleNotFound()
    {
        if (isset(self::$routes['login'])) {
            $route = self::$routes['login'];
            $controller = new $route['controller']();
            $method = $route['method'];
            $controller->$method();
        } else {
            http_response_code(404);
            echo "404 - Page Not Found";
        }
    }
}
