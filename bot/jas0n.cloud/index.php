<?php

    error_reporting(0);

    use Core\Router;

    require "Core/functions.php";

    spl_autoload_register(function ($class) {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        require $class;
    });

    require("bootstrap.php");
    $router = new Router();
    $routes = require("routes.php");

    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];

    $router->route($uri, $method);