<?php
namespace Bundle;

use App\Router\Route;
use App\Controller\UserController;

Route::get("/", "main.php");

Route::get("/gameAlonegame", [
	UserController::class, "userDetail", [
		"name" => "Hi",
		"id" => 12
	]
]);

Route::end();
