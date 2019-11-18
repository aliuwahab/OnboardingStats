<?php
namespace Temper\Controllers;

class StaticPages
{

    public function home(){
        return view('index');
    }


    public function about()
    {
        return view('about');
    }



}