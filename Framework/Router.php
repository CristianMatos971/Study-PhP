<?php

namespace Framework;

use App\controllers\ErrorController;
use Framework\middleware\Authorize;

class Router
{
    protected $routes = [];

    /**
     * Registrar as rotas do roteador a depender do método da request
     *
     * @param [string] $method
     * @param [string] $uri
     * @param [string] $action
     * @param array $middleware
     * @return void
     */
    function registerRoute($method, $uri, $action, $middleware = [])
    {
        list($controller, $controllerMethod) = explode('@', $action);

        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod,
            'middleware' => $middleware,
        ];
    }

    /**
     * Adicionar uma rota GET
     *
     * @param [string] $uri
     * @param [Controller] $controller
     * @param array $middleware
     * @return void
     */
    function get($uri, $controller, $middleware = [])
    {
        $this->registerRoute('GET', $uri, $controller, $middleware);
    }

    /**
     * Adicionar uma rota POST
     *
     * @param [string] $uri
     * @param [Controller] $controller
     * @param array $middleware
     * @return void
     */
    function post($uri, $controller, $middleware = [])
    {
        $this->registerRoute('POST', $uri, $controller, $middleware);
    }

    /**
     * Adicionar uma rota PUT
     *
     * @param [string] $uri
     * @param [Controller] $controller
     * @param array $middleware
     * @return void
     */
    function put($uri, $controller, $middleware = [])
    {
        $this->registerRoute('PUT', $uri, $controller, $middleware);
    }

    /**
     * Adicionar uma rota DELETE
     *
     * @param [string] $uri
     * @param [Controller] $controller
     * @param array $middleware
     * @return void
     */
    function delete($uri, $controller, $middleware = [])
    {
        $this->registerRoute('DELETE', $uri, $controller, $middleware);
    }


    function route($uri)
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if ($requestMethod === 'POST' && isset($_POST['_method'])) {
            $requestMethod = $_POST['_method'];
        }

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

                    foreach ($route['middleware'] as $role) {
                        (new Authorize())->handle($role);
                    }

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
        ErrorController::notFound();
    }
}
