<?php
class Router
{
    private static $routes = [];

    public static function get($page, $controller, $method)
    {
        self::$routes[$page] = [
            'controller' => $controller,
            'method' => $method
        ];
    }

    public static function dispatch()
    {
        $page = $_GET['page'] ?? 'login';

        if (isset(self::$routes[$page])) {
            $route = self::$routes[$page];
            $controller = new $route['controller']();
            $method = $route['method'];
            $controller->$method();
        } else {
            
            // default route kalo ga ketemu brok
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
}
