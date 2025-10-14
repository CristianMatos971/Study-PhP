<?php

class Router
{
    protected $routes = [];

    /**
     * Registrar as rotas do roteador a depender do método da request
     *
     * @param [string] $method
     * @param [string] $uri
     * @param [Controller] $controller
     * @return void
     */
    function registerRoutes($method, $uri, $controller)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
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
        $this->registerRoutes('GET', $uri, $controller);
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
        $this->registerRoutes('POST', $uri, $controller);
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
        $this->registerRoutes('PUT', $uri, $controller);
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
        $this->registerRoutes('DELETE', $uri, $controller);
    }

    /**
     * Carregar a página de um erro especifico a depender do código do erro
     *
     * @param integer $httpCode
     * @return void
     */
    function error($httpCode = 404)
    {
        http_response_code($httpCode = 404);
        loadView("error/$httpCode");
        exit;
    }

    function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                require basePath('App/' . $route['controller']);
                return;
            }
        }
        $this->error();
    }
}
