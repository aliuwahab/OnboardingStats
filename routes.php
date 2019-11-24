<?php

$router->get('', 'StaticPagesController@home');
$router->get('about', 'StaticPagesController@about');
$router->get('dashboard', 'DashboardController@index');

//    TODO:: Add a route middleware here to check if authenticated user is a temper Admin
$router->get('stats/onboarding', 'StatisticsController@getData'); // Get the data
