<?php
namespace Bundle;

class Bundler {
	function __construct() {
		// require(__DIR__ . "/Routes.php");
	}

	static public function bundle() {
		require(__DIR__ . "/Routes.php");
	}
}
