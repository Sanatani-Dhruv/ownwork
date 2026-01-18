<?php
namespace App\Router;

require __DIR__ . "/../../vendor/autoload.php";

class Route {
	public $uri;
	public $method;
	public $file;

	function __construct() {

	}

	public static function get(string $uri, string $view_name) {
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
				echo $content;
				fclose($file);
			}
		}
	}
}
