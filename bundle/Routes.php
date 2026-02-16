<?php
namespace Bundle;

use App\Router\Route;
use App\Controller\UserController;

$route = new Route();

$route->get("/", "main.php");

$route->get("/welcome", "welcome.php");

$route->get("/user/{name}/{id}", [
	UserController::class, "showDetail"
]);

$route->post("/user/update/{name}/{id}", [
	UserController::class, "showDetail"
]);

$route->end();
