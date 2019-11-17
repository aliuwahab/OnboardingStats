<?php
declare(strict_types=1);

// Load vendor folder to have access to PSR-4 autoloaded files
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Load bootstrap file
require "../boostrap.php";


$router = new Router();


require "../routes.php";


$uri = trim($_SERVER['REQUEST_URI'], '/');

require $router->dispatch($uri);


