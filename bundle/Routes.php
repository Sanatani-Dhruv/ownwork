<?php
namespace Bundle;

use App\Router\Route;
use App\Controller\UserController;

Route::get("/", "main.php");

Route::get("/game/Alone/game", [
	UserController::class, "showDetail", [
		"name" => "Hi",
		"id" => 11
	]
]);

Route::get("/welcome", [
	UserController::class, "welcome", [
		"name" => "Hi",
		"id" => 11
	]
]);

Route::end();
