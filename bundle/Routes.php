<?php
namespace Bundle;

use App\Helper\Router\Route;
use App\Controller\UserController;

$route = new Route();

$route->get("/", "ain.temp.php");

$route->end();
