<?php
namespace Bundle;

use Dhruv125\Coretex\Router\Route;
use App\Controller\UserController;

$route->get("/", "main.temp.php");

$route->globalMiddleware(function($request, $response, $next) {
	$next();
});

$route->globalMiddleware(function($request, $response, $next) {
	$next();
});

$route->get("/id/{id}/{name}", [
	UserController::class , 'index'
]);
