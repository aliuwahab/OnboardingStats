<?php



$router->get('', 'StaticPages@home');
$router->get('about', 'StaticPages@about');
$router->get('dashboard', 'Dashboard@index');

// Get the data
$router->post('stats', 'DataLayer@getData');
