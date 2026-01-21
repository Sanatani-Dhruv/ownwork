<?php
namespace Bundle;

use App\Helper\Environment;

class Bundler {
	function __construct() {
		// require(__DIR__ . "/Routes.php");
		require __DIR__ . '/../vendor/autoload.php';
	}

	public function bundle() {
		require(__DIR__ . "/Routes.php");
		Environment::setenv();
	}
}
