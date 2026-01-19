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
		$uris[$view_name] = $uri;
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
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0"/>
		<title>View Not Found</title>
	</head>
	<body style="background-color: lightgreen;">
		<h2 style="color: crimson; ">
			View with name <code>`<?=htmlspecialchars($view_name)?>`</code> not Found.
		</h2>
	</body>
</html>
<?php
			}
		}
	} 

	public static function end() {
		// echo "hi";
		echo "<pre>";
		print_r($GLOBALS['uris']);
		echo "</pre>";
		echo (isset($GLOBALS['uris']))? "True\n" : "False\n";
		for ($i = 0; $i < count($GLOBALS["uris"]); $i++) {
			// echo "hi";
			if ($_SERVER["REQUEST_URI"] == $GLOBALS['uris'][$i]) {
				$route_set = false;
			}
		}
	}
}
