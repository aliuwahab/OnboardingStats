<?php


namespace Temper\Controllers;


class StaticPagesController
{

    public function home(){
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

}