<?php
use App\Router\Route;

Route::get("/", "main.php");

Route::get("/welcome", "welcome.php");

Route::end();
