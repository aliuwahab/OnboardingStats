<?php

$router->get('', 'StaticPagesController@home');
$router->get('about', 'StaticPagesController@about');
$router->get('dashboard', 'DashboardController@index');

// Get the data
//    TODO:: Addd a route middleware here to check if authenticated user is a temper Admin
$router->get('stats/onboarding', 'StatisticsController@getData');
