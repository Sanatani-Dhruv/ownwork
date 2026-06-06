<?php
namespace Bundle;

use Bundle\Environment\Environment;

class Bundler {
	function __construct() {
		// require(__DIR__ . "/Routes.php");
		if (file_exists(__DIR__ . "/../.env") && file_exists(__DIR__ . "/../vendor/autoload.php")) {
			require __DIR__ . '/../vendor/autoload.php';
		} else {
			http_response_code(500);
			if (file_exists(__DIR__ . "/../resources/appviews/no-info-error.php")) {
				$error_title = htmlspecialchars("Setup Command Needed");
				$error_message = htmlspecialchars("Run Setup Command First!");
				$error_description = "Command:<br><code>composer run setup</code>";
				require(__DIR__ . "/../resources/appviews/no-info-error.php");
			}
			else
				echo "No Setup Command Ran!! Run <code>composer run setup</code>";
			die();
		}

		// Loading .env file from Root Directory
		require __DIR__ .'/Environment/Environment.php';
		$environment = new Environment();
		$environment->setenv();

		// var_dump(getenv('OWNWORK_ERROR_HANDLER'));
		// $doHandler = strtolower(getenv('OWNWORK_ERROR_HANDLER'));
		// if($doHandler == "true" || $doHandler == "1") {
		// 	require(__DIR__ . "/ErrorHandler/Handler.php");
		// }

		// Global Helper Functions exist in below file
		require __DIR__ . '/HelperFunction.php';
		//
		// Error Handler Setup for Application
		require(__DIR__ . "/ErrorHandler/Handler.php");
	}

	public function bundle() {
		try {
			require(__DIR__ . "/Routes.php");
		} catch (Exception $err) {
			echo $err;
		}
	}
}
