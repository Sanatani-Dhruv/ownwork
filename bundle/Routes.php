<?php
namespace Bundle;

use Dhruv125\Coretex\Router\Route;
use App\Controller\UserController;

$route->get("/", "main.temp.php");

$route->globalMiddleware(function($request, $response, $currentRoute, $params, $next) {
	$next();
});

$route->globalMiddleware(function($request, $response, $currentRoute, $params, $next) {
	$next();
});

$route->get("/id/{id}/{name}", [
	UserController::class , 'index'
]);

$route->globalMiddleware([
	\App\Middleware\RateLimiter::class, 'handle'
]);
