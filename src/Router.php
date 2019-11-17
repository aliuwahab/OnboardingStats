<?php


/**
 * Class Router
 */
class Router
{

    public $routes  = [];

    public function register($routes){
        $this->routes = $routes;
    }



    public function dispatch($uri)
    {
        if (array_key_exists($uri, $this->routes)) {

            return $this->routes[$uri];
        }

        throw new RouteNotFoundException("The route ". $uri. "does not exist");
    }



}