<?php
namespace Bundle;

use Bundle\Environment\Environment;
use Bundle\RateLimiter\Limiter;

class Bundler {
	function __construct() {
		// Look for .env and autoload.php file
		if (file_exists(__DIR__ . "/../.env") && file_exists(__DIR__ . "/../vendor/autoload.php")) {
			require __DIR__ . '/../vendor/autoload.php';
		} else {
			// Show Error Page
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

		// Global Helper Functions exist in below file
		require __DIR__ . '/HelperFunction.php';

		// Error Handler Setup for Application
		require(__DIR__ . "/ErrorHandler/Handler.php");

		// Error Handler Setup for Application
		require(__DIR__ . "/RateLimiter/Limiter.php");
		$limiter = new Limiter();
		$limiter->setTimeLimit(60);
		$limiter->status(1);
	}

	public function bundle() {
		try {
			require(__DIR__ . "/Routes.php");
		} catch (Exception $err) {
			echo $err;
		}
	}
}
