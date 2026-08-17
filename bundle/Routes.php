<?php
namespace Bundle;

use Dhruv125\Coretex\Router\Route;
use App\Controller\UserController;

$route->get("/", "main.temp.php");

$route->get("/id/{id}/{name}", [
	UserController::class , 'index'
]);
