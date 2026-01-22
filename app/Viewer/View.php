<?php
namespace App\Viewer;

use App\Router\Route;

class View {
	private $uri;
	private $viewLocation;

	function __construct() {
		$this->viewLocation = __DIR__ . "/../../resources/views/";
	}

	public function view($viewName) {
		if (file_exists($this->viewLocation . $viewName)) {
			require($this->viewLocation . $viewName);
		} else {
			if (file_exists(__DIR__ . "/../Helper/Views/view-notfound-error.php")) {
				$viewName_methodCall = $viewName;
				require(__DIR__ . "/../Helper/Views/view-notfound-error.php");
			} else {
				echo "<pre>View Not Found</pre>";
			}
		}
	}


	public static function instantView($viewName) {
		$viewLocation = __DIR__ . "/../../resources/views/";
		if (file_exists($viewLocation . $viewName)) {
			require($viewLocation . $viewName);
		} else {
			if (file_exists(__DIR__ . "/../Helper/Views/view-notfound-error.php")) {
				$viewName_methodCall = $viewName;
				require(__DIR__ . "/../Helper/Views/view-notfound-error.php");
			} else {
				echo "<pre>View Not Found</pre>";
			}
		}
	}
}
