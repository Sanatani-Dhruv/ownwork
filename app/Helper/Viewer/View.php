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


	public static function instantView($viewName, array $keyValue = []) {
		$viewLocation = __DIR__ . "/../../../resources/views/";

		if (file_exists($viewLocation . $viewName)) {
			if (count($keyValue)) {
				extract($keyValue);
			}
			if (strstr($viewName, "temp.php")) {
				$approot = approot();
				$compiledViewStorageDir = $approot . "/storage/views/";
				$compiledViewDetailPath = $approot . "/storage/views.json";

				if (!file_exists($compiledViewDetailPath)) {
					throw new \ErrorException("views.json not found at " . dirname($compiledViewDetailPath));
				}
				$compiledViewDetails = json_decode(file_get_contents($compiledViewDetailPath));
				try {
					$compiledViewPath = $compiledViewStorageDir . $compiledViewDetails->{$approot . "/resources/views/" . $viewName};
					if (file_exists($compiledViewPath))
						require($compiledViewPath);
					else {
						throw new \Exception("View Not Found");
					}
				} catch(\Exception $err) {
					if (file_exists(__DIR__ . "/../AppViews/view-notfound-error.php")) {
						require(__DIR__ . "/../AppViews/view-notfound-error.php");
					} else {
						echo "<pre>View Not Found</pre>";
					}
				}
			} else {
				require($viewLocation . $viewName);
			}
		} else {
			if (file_exists(__DIR__ . "/../AppViews/view-notfound-error.php")) {
				require(__DIR__ . "/../AppViews/view-notfound-error.php");
			} else {
				echo "<pre>View Not Found</pre>";
			}
		}
	}
}
