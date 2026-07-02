<?php
namespace Bundle;

use Dhruv125\Coretex\Environment\Environment;
use Dhruv125\Coretex\Handler\GlobalErrorHandler;
use Dhruv125\Coretex\Exceptions\PageNotFoundException;
use Dhruv125\Coretex\Exceptions\ViewNotFoundException;

use App\Http\Kernel;

class Bundler {
	private $pager;
	public function __construct() {
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
		$environment = new Environment();
		$errorLevel = $environment->setenv();

		$handler = new GlobalErrorHandler($errorLevel);
	}

	public function bundle() {
		$kernel = new Kernel();
		$kernel->handle();
	}
}
