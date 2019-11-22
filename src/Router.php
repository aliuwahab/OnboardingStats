<?php
namespace Temper;


use phpDocumentor\Reflection\Types\Context;
use PresenterInterface;
use Temper\Controllers\DashboardController;
use Temper\Controllers\StaticPagesController;
use Temper\Exceptions\MethodDoesNotExistException;
use Temper\Exceptions\RouteNotFoundException;
use Temper\Controllers\StatisticsController;
use Temper\Presenters\OnBoardingPresenter;
use Temper\Repositories\OnboardingRepository;
use Temper\Repositories\RepositoryInterface;
use function DI\get;

/**
 * Class Router
 */
class Router
{

    public $container;

    public function __construct()
    {

        $containerBuilder = new \DI\ContainerBuilder();
        $containerBuilder->useAutowiring(true);
        $containerBuilder->useAnnotations(false);
        $this->container = $containerBuilder->build();

    }

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

        $loadController = $this->container->get(StatisticsController::class);
        if (! method_exists($loadController, $method)) {

            throw new MethodDoesNotExistException("This method does not exist in this controller");
        }
        return $loadController->$method();
    }


}