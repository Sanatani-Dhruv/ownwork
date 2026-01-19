<?php
namespace App\Router;

require __DIR__ . "/../../vendor/autoload.php";

class Route {
	public $uri;
	public $method;
	public $file;
	// private $uris;
	static $uris;

	function __construct($uris = array()) {
		$this->uris = $uris;
	}

	public static function get(string $uri, string $view_name) {
		global $uris;
		$uris[$uri] = $view_name;
		if ($_SERVER["REQUEST_URI"] == $uri){
			$file_name = __DIR__ . "/../Views/" . "$view_name";
			// echo $file_name;
			$file_exist_status = (file_exists($file_name)) ? 1 : 0;
			if ($file_exist_status) {
				$file = fopen($file_name, 'r');
				// echo $file_exist_status;
				$content = fread($file, filesize($file_name));
				// echo $file_name;
				// $content = file_get_contents($file_name, FILE_USE_INCLUDE_PATH);
				// $content = file_get_contents('http://www.example.com/');
				// return $content;
				require($file_name);
				fclose($file);
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
		// echo "hi";
		// echo "<pre>";
		// print_r($GLOBALS['uris']);
		// echo "</pre>";
		// echo (isset($GLOBALS['uris']))? "True\n" : "False\n";
		$route_set = false;
		for ($i = 0; $i < count($GLOBALS["uris"]); $i++) {
			// echo "hi";
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
