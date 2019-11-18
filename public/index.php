<?php
declare(strict_types=1);

use Temper\Request;
use Temper\Router;

require_once dirname(__DIR__) . '/vendor/autoload.php';
// Load bootstrap file
require "../bootsrap.php";

//Load routes direct a request to the appropriate route
Router::load('../routes.php')->dispatch(Request::uri(), Request::method());


