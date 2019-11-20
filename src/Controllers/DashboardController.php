<?php
namespace Temper\Controllers;

use League\Csv\Exception as CSVException;
use League\Csv\Reader;
use League\Csv\Statement;

class DashboardController
{

    public function index()
    {
        return view('dashboard');
    }




}