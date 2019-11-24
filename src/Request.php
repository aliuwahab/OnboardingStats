<?php


namespace Temper;


/**
 * Class Request
 * @package Temper
 */
class Request
{

    /**
     * This retrieves the request uri e.g /stats/onboarding
     * @return mixed
     */
    public static function uri(){

        return parse_url(trim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH);
    }

    /**
     * This retrieves the current request method e.g, get, post, put or patch
     * @return mixed
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

}