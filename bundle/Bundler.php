<?php
namespace Bundle;

use Bundle\Environment\Environment;

class Bundler {
	function __construct() {
		// require(__DIR__ . "/Routes.php");
		try {
			require __DIR__ . '/../vendor/autoload.php';
		} catch (Exception $err) {
			echo "It looks like you didn't ran Startup Command; run <code>composer run setup</code> in ownwork directory!!";
		}
		require __DIR__ . '/HelperFunction.php';
		require __DIR__ .'/Environment/Environment.php';

		$environment = new Environment();
		$environment->setenv();
	}

	public function bundle() {
		try {
			require(__DIR__ . "/Routes.php");
		} catch (Exception $err) {
			echo $err;
		}
	}
}
