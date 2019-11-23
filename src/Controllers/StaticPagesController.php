<?php


namespace Temper\Controllers;

/**
 * Class StaticPagesController
 * @package Temper\Controllers
 */
class StaticPagesController
{

    /**
     * @return mixed
     */
    public function home(){
        return view('index');
    }

    /**
     * @return mixed
     */
    public function about()
    {
        return view('about');
    }

}