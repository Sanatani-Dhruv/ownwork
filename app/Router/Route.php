<?php
namespace App\Router;

class Route {
	public $uri;
	public $method;
	public $file;
	static $uris;
	private $viewName_methodCall;
	private $displayedView;

	function __construct() {
		if (!isset($_SERVER["PATH_INFO"])) {
			$_SERVER["PATH_INFO"] = "/";
		}

		$this->displayedView = 0;
	}

	public function get(string $uri, $viewName_methodCall) {
		global $uris;
		$uris[$uri] = $viewName_methodCall;
		$this->viewName_methodCall = $viewName_methodCall;
	} 

	public function __destruct() {
	if ($this->displayedView == 0) {
		foreach ($GLOBALS["uris"] as $uri => $array) {
			if ($_SERVER["PATH_INFO"] == $uri && strtoupper($_SERVER["REQUEST_METHOD"]) == 'GET') {
				// If String is passed, it should be viewname, so view will be rendered
				if (is_string($this->viewName_methodCall)) {
					$file_name = __DIR__ . "/../../resources/views/" . "$viewName_methodCall";
					// echo $file_name;
					$file_exist_status = (file_exists($file_name)) ? 1 : 0;
					if ($file_exist_status) {
						$this->displayedView = 1;
						require($file_name);
					} else {
						if (file_exists(__DIR__ . "/../Helper/Views/view-notfound-error.php")) {
							require(__DIR__ . "/../Helper/Views/view-notfound-error.php");
						} else {
							echo "<h1>View with name <code>`$viewName_methodCall`</code> not Found.<h1>";
						}
					}
					// If Array is passed, then it should be for calling method of a Controller class, and also we pass variables in form of key value pair array
				} elseif (is_array($this->viewName_methodCall)) {
					// echo "<pre>";
					// print_r($viewName_methodCall);
					// echo "</pre>";

					if (is_string($this->viewName_methodCall[0]) && is_string($this->viewName_methodCall[1]) && is_array($this->viewName_methodCall[2])) {
						// echo "First is string<br>";
						// echo "Second is string<br>";
						// echo "Third is Array<br>";
						$arrayClass = $this->viewName_methodCall[0];
						$arrayMethod = $this->viewName_methodCall[1];
						$arrayObject = new ($arrayClass);
						// print_r($arrayObject);
						// echo $arrayMethod;
						try {
							extract($this->viewName_methodCall[2]);
							$arrayObject->{$arrayMethod}();
						} catch (Exception $err) {
							echo $err;
						}
						// print_r($arrayObject->$arrayMethod);
						$isAssociative = array_values($this->viewName_methodCall[2]) !== $this->viewName_methodCall[2];

					}
				}
			}
		}
	} else {

	}
		$route_set = false;
		for ($i = 0; $i < count($GLOBALS["uris"]); $i++) {
			if (isset($GLOBALS["uris"][$_SERVER["PATH_INFO"]])) {
				$route_set = true;
			}
		}

		if (!$route_set) {
			if (file_exists(__DIR__ . "/../Helper/Views/general-notfound-error.php")) {
				include(__DIR__ . "/../Helper/Views/general-notfound-error.php");
			} else {
				http_response_code(404);
				echo " <h2><code>Error: 404 Not Found</code></h2> ";
			}
		}
	}
}
