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
            'middlewares' => [],
            'type' => 'web' // default adalah web route
        ];

        return new static();
    }

    // Method baru untuk AJAX routes
    public static function api($page, $controller, $method)
    {
        self::$currentRoute = $page;
        self::$routes[$page] = [
            'controller' => $controller,
            'method' => $method,
            'middlewares' => [],
            'type' => 'ajax' // tandai sebagai ajax route
        ];

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

        if (isset(self::$routes[$page])) {
            $route = self::$routes[$page];

            // Validasi untuk AJAX routes
            if ($route['type'] === 'ajax') {
                $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

                if (!$isAjax) {
                    http_response_code(400);
                    header('Content-Type: application/json');
                    echo json_encode(['error' => 'Invalid request type. AJAX required.']);
                    return;
                }
            }

            // Run middlewares
            foreach ($route['middlewares'] as $middleware) {
                if (!class_exists($middleware)) {
                    if ($route['type'] === 'ajax') {
                        http_response_code(500);
                        header('Content-Type: application/json');
                        echo json_encode(['error' => "Middleware {$middleware} not found"]);
                        return;
                    }
                    die("Middleware {$middleware} not found!");
                }

                $middlewareInstance = new $middleware();
                if (!$middlewareInstance->handle()) {
                    return;
                }
            }

            // Run controller
            if (!class_exists($route['controller'])) {
                if ($route['type'] === 'ajax') {
                    http_response_code(500);
                    header('Content-Type: application/json');
                    echo json_encode(['error' => "Controller {$route['controller']} not found"]);
                    return;
                }
                die("Controller {$route['controller']} not found!");
            }

            $controller = new $route['controller']();
            $method = $route['method'];

            if (!method_exists($controller, $method)) {
                if ($route['type'] === 'ajax') {
                    http_response_code(500);
                    header('Content-Type: application/json');
                    echo json_encode(['error' => "Method {$method} not found"]);
                    return;
                }
                die("Method {$method} not found in {$route['controller']}!");
            }

            $controller->$method();
        } else {
            self::handleNotFound();
        }
    }

    private static function handleNotFound()
    {
        // Cek apakah request adalah AJAX
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

        if ($isAjax) {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Route not found']);
            return;
        }

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
