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


    function route($uri)
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            $uriSegments = explode('/', trim($uri, '/'));

            $routeSegments = explode('/', trim($route['uri'], '/'));

            $match = true;

            if (count($uriSegments) === count($routeSegments) && strtoupper($requestMethod) === $route['method']) {
                $params = [];
                $match = true;
                for ($i = 0; $i < count($uriSegments); $i++) {
                    //Se as uris não são compatíveis e não há parametro '/'
                    if ($uriSegments[$i] !== $routeSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
                        $match = false;
                        /* inspect($uriSegments);
                        echo '</br>----------------------------</br>';
                        inspect($routeSegments); */
                        break;
                    }

                    if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        $params[$matches[1]] = $uriSegments[$i];
                        /* inspectAndDie($params); */
                    }
                }

                // Se, após verificar todos os segmentos, a rota ainda for válida...
                if ($match) {
                    // Chame o controller e o método
                    $controller = 'App\\Controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];

                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params); // Passe os parâmetros

                    // Pare o roteador para não verificar outras rotas
                    return;
                }
            }
        }
    }
}
