<?php

// require_once _DIR_ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';


use App\Core\Router;

$router = new Router();
$router->dispatch();


?>