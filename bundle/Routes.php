<?php
namespace Bundle;

use App\Helper\Router\Route;
use App\Controller\UserController;

$route = new Route();

$route->get("/", "main.temp.php");
$route->get("/api", function() {
	jsonHeader();
	$arr = [
		"time" => microtime(),
		"ip" => $_SERVER['REMOTE_ADDR']
	];
	$json = json_encode($arr);
	echo $json;
});

$route->end();
