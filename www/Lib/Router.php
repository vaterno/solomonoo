<?php

namespace Lib;

use Lib\Enums\HttpMethods;

class Router
{
    protected array $getRoutes = [];

    public function add(string $url, string $controller, string $action, HttpMethods $method = HttpMethods::GET)
    {
        $data = [
            'url' => $url,
            'controller' => $controller,
            'method' => $method,
            'action' => $action,
        ];

        $this->getRoutes[$url] = $data;
    }

    public function run(Request $request)
    {
        $route = $this->getRoutes[$request->getUrl()] ?? null;

        if (empty($route)) {
            die('Unknown page');
        }

        $method = $route['action'];
        $controller = new ($route['controller'])($request);
        $controller->$method();
    }
}
