<?php
namespace App\Helper\Viewer;

use App\Helper\Router\Route;

class View {
	private $uri;
	private $viewLocation;

	function __construct() {
		//
	}

	public function view($viewName, array $keyValue = []) {
		$this::instantView($viewName, $keyValue);
	}

	public static function includeTemp(string $tempName, bool $givePath = false, array $pairs = []) {
		$approot = approot();
		$compiledViewStorageDir = $approot . "/storage/views/";
		$compiledViewDetailPath = $approot . "/storage/views.json";

		if (!file_exists($compiledViewDetailPath)) {
			throw new \ErrorException("views.json not found at " . dirname($compiledViewDetailPath));
		}
		$compiledViewDetails = json_decode(file_get_contents($compiledViewDetailPath), true);
		try {
			$compiledViewPath = $compiledViewStorageDir . $compiledViewDetails[$approot . "/resources/views/" . $tempName];
			if (file_exists($compiledViewPath)) {
				if (count($pairs)) extract($pairs);
				if (!$givePath) {
					require($compiledViewPath);
					return;
				} else {
					return $compiledViewPath;
				}
			}
			else {
				throw new \Exception("View Not Found");
			}
		} catch(\Exception $err) {
			if (file_exists(approot() . "/resources/appviews/no-info-error.php")) {
				$error_title = "View Not Found";
				$error_message = out("View with name `$tempName` not Found.");
				require(approot() . "/resources/appviews/no-info-error.php");
			} else {
				echo "<pre>View Not Found</pre>";
			}
			exit();
		}
	}

	public static function instantView($viewName, array $keyValue = []) {
		$viewLocation = __DIR__ . "/../../../resources/views/";

		if (file_exists($viewLocation . $viewName)) {
			if (count($keyValue)) {
				extract($keyValue);
			}
			if (strstr($viewName, "temp.php")) {
				self::includeTemp($viewName, false, $keyValue);
			} else {
				require($viewLocation . $viewName);
			}
			exit();
		} else {
			if (file_exists(approot() . "/resources/appviews/no-info-error.php")) {
				$error_title = "View Not Found";
				$error_message = out("View with name `$tempName` not Found.");
				require(approot() . "/resources/appviews/no-info-error.php");
				exit();
			} else {
				echo "<pre>View Not Found</pre>";
				exit();
			}
		}
	}
}
