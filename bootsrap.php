<?php

//$app = [];
//
//
//$app['database'] = new \Temper\Database\Connector();


use Temper\Controllers\DashboardController;
use Temper\Controllers\StaticPagesController;
use Temper\Controllers\StatisticsController;
use Temper\Exceptions\MethodDoesNotExistException;
use Temper\Exceptions\RouteNotFoundException;
use Temper\Repositories\OnboardingRepository;
use Temper\Repositories\RepositoryInterface;
use function DI\get;

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->useAutowiring(false);
$containerBuilder->useAnnotations(false);
$containerBuilder->addDefinitions([
    StatisticsController::class => \DI\create(StatisticsController::class)
        ->constructor(get(OnboardingRepository::class)),
    OnboardingRepository::class => \DI\create(OnboardingRepository::class),
    PresenterInterface::class => \DI\create(PresenterInterface::class),
    MethodDoesNotExistException::class => \DI\create(MethodDoesNotExistException::class),
    RouteNotFoundException::class => \DI\create(RouteNotFoundException::class),
    RepositoryInterface::class => \DI\create(RepositoryInterface::class),
    DashboardController::class => \DI\create(DashboardController::class),
    StaticPagesController::class => \DI\create(StaticPagesController::class),
]);

$container = $containerBuilder->build();

//$helloWorld = $container->get(StatisticsController::class);
//$helloWorld->getData();

//require "views/index.view.php";

require "src/Router.php";



// Helper to load views
function view($view, array $data = [])
{
    // Extract the keys of the data posted into variables
    extract($data);

    return require "views/$view.view.php";
}