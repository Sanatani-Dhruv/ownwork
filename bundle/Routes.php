<?php
namespace Bundle;

use Dhruv125\Coretex\Router\Route;
use App\Controller\UserController;

$route->get("/", "main.temp.php");

$route->globalMiddleware(function($request, $response, $next) {
	return $next();
});

$route->globalMiddleware(function($request, $response, $next) {
	return $next();
});

$route->get("/id/{id}/{name}", [
	UserController::class , 'index'
]);
