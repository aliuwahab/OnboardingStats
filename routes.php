<?php



$router->get('', 'StaticPagesController@home');
$router->get('about', 'StaticPagesController@about');
$router->get('dashboard', 'DashboardController@index');

// Get the data
$router->get('stats/onboarding', 'StatisticsController@getData');
