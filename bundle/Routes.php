<?php
namespace Bundle;

use Dhruv125\Coretex\Router\Route;
use App\Controller\UserController;

$route->get("/", "main.temp.php");

$route->get("/id/{id}/{name}", [
	UserController::class , 'index'
]);

$route->middleware("get", "/id/{id}/{name}", function($currentUrl) {
	// print_r($currentUrl);
});
