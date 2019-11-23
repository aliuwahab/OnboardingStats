<?php


namespace Temper\Controllers;

/**
 * Class DashboardController
 * @package Temper\Controllers
 */
class DashboardController
{
    /**
     * Returns the view for dashboard
     * @return mixed
     */
    public function index()
    {
        return view('dashboard');
    }


}