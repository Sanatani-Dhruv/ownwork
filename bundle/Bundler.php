<?php
namespace Bundle;

use Dhruv125\Coretex\Environment\Environment;
use Dhruv125\Coretex\Handler\GlobalErrorHandler;
use Dhruv125\Coretex\Exceptions\PageNotFoundException;
use Dhruv125\Coretex\Exceptions\ViewNotFoundException;
use Dhruv125\Coretex\Pager;

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

		// Initialize Error Displayer
		$this->pager = new Pager();

		// Loading .env file from Root Directory
		$environment = new Environment();
		$errorLevel = $environment->setenv();

		$handler = new GlobalErrorHandler($errorLevel);
	}

	public function bundle() {
		try {
			$kernel = new Kernel();
			$kernel->handle();
		} catch (PageNotFoundException $err) {
			http_response_code(404);
			$this->pager->notFoundPage();
		} catch (ViewNotFoundException $err) {
			http_response_code(500);
			$this->pager->viewNotFoundPage($err->viewName);
		}
	}
}
