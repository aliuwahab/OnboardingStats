<?php
namespace Temper;


use phpDocumentor\Reflection\Types\Context;
use Temper\Exceptions\MethodDoesNotExistException;
use Temper\Exceptions\RouteNotFoundException;

/**
 * Class Router
 */
class Router
{

    public $routes  = [
        'GET' => [],
        'POST' => [],
        'PATCH' => [],
        'PUT' => [],
    ];

    public function register($routes){
        $this->routes = $routes;
    }


    public static function load($file)
    {

        $router = new static;

        // load routes file
        require $file;

        return $router;
    }



    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }


    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function patch($uri, $controller)
    {
        $this->routes['PATCH'][$uri] = $controller;
    }


    public function put($uri, $controller)
    {
        $this->routes['PUT'][$uri] = $controller;
    }


    public function dispatch($uri, $requestType)
    {

//        var_dump($uri, $requestType); exit();
//        $controller = end(explode('/',$this->routes[$uri]));
//        var_dump($controller); exit();
//        return new $controller;

        if (array_key_exists($uri, $this->routes[$requestType])) {

            return $this->loadAction(...explode("@", $this->routes[$requestType][$uri]));

        }
        throw new RouteNotFoundException("The route: ". $uri. " does not exist");
    }





    private function loadAction($controller, $method){

        $controller = "Temper\\Controllers\\{$controller}";
        $controller = new $controller;

        if (! method_exists($controller, $method)) {

            throw new MethodDoesNotExistException("This method does not exist in this controller");
        }

        return (new $controller)->$method();
    }


}