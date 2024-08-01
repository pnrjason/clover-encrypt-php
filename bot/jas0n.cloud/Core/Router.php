<?php

namespace Core;

class Router {
    protected $routes = [];

    public function add($method, $uri, $controller) {
        $uri = preg_replace('/\{([^\/]+)\}/', '(?P<$1>[^/]+)', $uri);

        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    public function get($uri, $controller) {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller) {
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller) {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller) {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller) {
        return $this->add('PUT', $uri, $controller);
    }

    public function only($middleware) {
        $this->routes[array_key_last($this->routes)]['middleware'] = $middleware;
        return $this;
    }

    public function route($uri, $method) {
        foreach ($this->routes as $route) {
            if (preg_match('#^' . $route['uri'] . '$#', $uri, $matches) AND $route['method'] === strtoupper($method)) {
                $params = array_filter($matches, function($key) {
                    return !is_numeric($key);
                }, ARRAY_FILTER_USE_KEY);

                foreach ($params as $key => $value) {
                    $_GET[$key] = $value;
                }

                session_start();
                if (isset($route['middleware']) AND $route['middleware'] === 'admin') {
                    if (! isset($_SESSION['logged_in']) OR $_SESSION['logged_in'] !== true) {
                        header("Location: /admin-panel");
                        exit;
                    }
                }

                return require $route['controller'];
            }
        }

        $this->abort();
    }

    public function abort($code = 404) {
        http_response_code($code);
        require "controllers/$code.php";
        die();
    }
}