<?php


namespace Test\Feature;


use Temper\Exceptions\RouteNotFoundException;
use Temper\Presenters\OnBoardingPresenter;
use Temper\Router;
use Test\TemperTest;

class RouterTest extends TemperTest
{

    /**
     * @test
     */
    public function testInValidRouteWillThrowAnException(){

        $this->expectException(RouteNotFoundException::class);

        $router = $this->container->get(Router::class);
        $router->dispatch('/sample', 'GET');

    }



//    TODO:: Could test the other methods in Router.php class

}