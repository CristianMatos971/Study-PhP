<?php

namespace Framework;

use App\controllers\ErrorController;

class Router
{
    protected $routes = [];

    /**
     * Registrar as rotas do roteador a depender do método da request
     *
     * @param [string] $method
     * @param [string] $uri
     * @param [string] $action
     * @return void
     */
    function registerRoute($method, $uri, $action)
    {
        list($controller, $controllerMethod) = explode('@', $action);

        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
    }

    /**
     * Adicionar uma rota GET
     *
     * @param [string] $uri
     * @param [Controller] $controller
     * @return void
     */
    function get($uri, $controller)
    {
        $this->registerRoute('GET', $uri, $controller);
    }

    /**
     * Adicionar uma rota POST
     *
     * @param [string] $uri
     * @param [Controller] $controller
     * @return void
     */
    function post($uri, $controller)
    {
        $this->registerRoute('POST', $uri, $controller);
    }

    /**
     * Adicionar uma rota PUT
     *
     * @param [string] $uri
     * @param [Controller] $controller
     * @return void
     */
    function put($uri, $controller)
    {
        $this->registerRoute('PUT', $uri, $controller);
    }

    /**
     * Adicionar uma rota DELETE
     *
     * @param [string] $uri
     * @param [Controller] $controller
     * @return void
     */
    function delete($uri, $controller)
    {
        $this->registerRoute('DELETE', $uri, $controller);
    }


    function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                $controller = '\\App\\Controllers\\' . $route['controller'];
                $controllerMethod = $route['controllerMethod'];

                $controllerInstance = new $controller();
                $controllerInstance->$controllerMethod();
                return;
            }
        }
        ErrorController::notFound();
    }
}
