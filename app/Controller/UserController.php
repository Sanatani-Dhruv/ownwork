<?php
namespace App\Controller;

use App\Router\Route;

class UserController {
	function __construct() {
		//
	}

	public function showDetail() {
		echo "Hi";
	}

	public function welcome() {
		require(__DIR__ . "/../../app/Views/welcome.php");
	}
}
