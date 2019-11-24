<?php
namespace Temper;


use Temper\Exceptions\MethodDoesNotExistException;
use Temper\Exceptions\RouteNotFoundException;
use Temper\Models\OnBoardingDataInterface;
use Temper\Responses\OnboardingStatsApiResponse;
use Temper\Responses\ResponsableInterface;
use Temper\Services\CsvReaderService;
use function DI\get;

/**
 * Class Router
 */
class Router
{

    public $container;

    /**
     * Router constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        //Set DI container
        $containerBuilder = new \DI\ContainerBuilder();
        $containerBuilder->useAutowiring(true);
        $containerBuilder->useAnnotations(false);
        $containerBuilder->addDefinitions([
            ResponsableInterface::class => get(OnboardingStatsApiResponse::class),
            OnBoardingDataInterface::class => get(CsvReaderService::class),
        ]);
        $this->container = $containerBuilder->build();

    }

    /**
     * @var array
     */
    public $routes  = [
        'GET' => [],
        'POST' => [],
        'PATCH' => [],
        'PUT' => [],
    ];

    /**
     * @param $routes
     */
    public function register($routes){
        $this->routes = $routes;
    }

    /**
     * Thus loads the route file
     * @param $file
     * @return static
     * @throws \Exception
     */
    public static function load($file)
    {

        $router = new static;

        // load routes file
        require $file;

        return $router;
    }


    /**
     * This loads the get routes
     * @param $uri
     * @param $controller
     */
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }


    /**
     * This loads the post routes
     * @param $uri
     * @param $controller
     */
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * * This loads the patch routes
     * @param $uri
     * @param $controller
     */
    public function patch($uri, $controller)
    {
        $this->routes['PATCH'][$uri] = $controller;
    }


    /**
     * This loads the put routes
     * @param $uri
     * @param $controller
     */
    public function put($uri, $controller)
    {
        $this->routes['PUT'][$uri] = $controller;
    }


    /**
     * @param $uri
     * @param $requestType
     * @return mixed
     * @throws MethodDoesNotExistException
     * @throws RouteNotFoundException
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function dispatch($uri, $requestType)
    {

        if (array_key_exists($uri, $this->routes[$requestType])) {
            // This explodes to get the appropriate controller and the method
            return $this->loadAction(...explode("@", $this->routes[$requestType][$uri]));

        }
        throw new RouteNotFoundException("The route: ". $uri. " does not exist");
    }


    /**
     * Load the appropriate controller and method
     * @param $controller
     * @param $method
     * @return mixed
     * @throws MethodDoesNotExistException
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    private function loadAction($controller, $method){
        $classNameSpace = 'Temper\\Controllers\\'.$controller;
        $loadController = $this->container->get($classNameSpace);
        if (! method_exists($loadController, $method)) {

            throw new MethodDoesNotExistException("This method does not exist in the controller ".$controller);
        }
        return $loadController->$method();
    }


}