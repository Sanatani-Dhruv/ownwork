<?php
namespace App\Router;

require __DIR__ . "/../../vendor/autoload.php";

class Route {
	public $uri;
	public $method;
	public $file;
	static $uris;

	function __construct($uris = array()) {
		$this->uris = $uris;
	}

	public static function get(string $uri, string $view_name) {
		global $uris;
		$uris[$uri] = $view_name;
		if ($_SERVER["REQUEST_URI"] == $uri){
			$file_name = __DIR__ . "/../Views/" . "$view_name";
			$file_exist_status = (file_exists($file_name)) ? 1 : 0;
			if ($file_exist_status) {
				require($file_name);
			} else {
				if (file_exists(__DIR__ . "/../Helper/Views/view-notfound-error.php")) {
					require(__DIR__ . "/../Helper/Views/view-notfound-error.php");
				} else {
					echo "<h1>View with name <code>`$view_name`</code> not Found.<h1>";
				}
			}
		}
	} 

	public static function end() {
		$route_set = false;
		for ($i = 0; $i < count($GLOBALS["uris"]); $i++) {
			if (isset($GLOBALS["uris"][$_SERVER["REQUEST_URI"]])) {
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
