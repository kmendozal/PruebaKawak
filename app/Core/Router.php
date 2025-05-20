<?php
namespace App\Core;

class Router
{
    public function dispatch()
    {
        $basePath = '/document_crud/public'; // Lo agrego porque no tengo el proyecto en la raiz del proyecto
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Quitamos el base path
        if (str_starts_with($uri, $basePath)) {
            $uri = substr($uri, strlen($basePath));
        }

        $uri = trim($uri, '/');
        $segments = explode('/', $uri);

        $controllerName = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'HomeController';
        $method = $segments[1] ?? 'index';
        $params = array_slice($segments, 2);

        $controllerClass = 'App\\Controllers\\' . $controllerName;

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], $params);
                return;
            }
        }

        http_response_code(404);
        echo "Página no encontrada: $uri";
    }
}
