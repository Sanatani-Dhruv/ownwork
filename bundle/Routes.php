<?php
namespace Bundle;

use App\Router\Route;
use App\Controller\UserController;

Route::get("/", "main.php");

Route::get("/gameAlonegame", [
	UserController::class, "showDetail()", [
		"name" => "Hi",
		"id" => 11
	]
]);

Route::end();
