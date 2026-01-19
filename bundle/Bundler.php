<?php
namespace Bundle;

class Bundler {
	function __construct() {
		require(__DIR__ . "/Routes.php");
	}
}
