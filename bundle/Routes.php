<?php
namespace Bundle;

use Coretex\Router\Route;
use App\Controller\UserController;

$route = new Route();

$route->get("/", "main.temp.php");

$route->end();
