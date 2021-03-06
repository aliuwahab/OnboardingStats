<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use ReflectionClass;

class TemperTest extends TestCase
{



    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        require_once dirname(__DIR__) . '/vendor/autoload.php';
        require_once dirname(__DIR__).'/ENV_VAR.php';
        //Set DI container
        require dirname(__DIR__).'/configuration/DI.php';
    }


    /**
     * This allows to test private methods
     * @param $object
     * @param $methodName
     * @param array $parameters
     * @return mixed
     * @throws \ReflectionException
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }

}