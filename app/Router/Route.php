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
<<<<<<< HEAD
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
=======
		if ($_SERVER["PATH_INFO"] == $uri && strtoupper($_SERVER["REQUEST_METHOD"]) == 'GET') {
			// If String is passed, it should be viewname, so view will be rendered
			if (is_string($viewName_methodCall)) {
				$file_name = __DIR__ . "/../../resources/views/" . "$viewName_methodCall";
				// echo $file_name;
				$file_exist_status = (file_exists($file_name)) ? 1 : 0;
				if ($file_exist_status) {
					require($file_name);
				} else {
					if (file_exists(__DIR__ . "/../Helper/Views/view-notfound-error.php")) {
						require(__DIR__ . "/../Helper/Views/view-notfound-error.php");
					} else {
						echo "<h1>View with name <code>`$viewName_methodCall`</code> not Found.<h1>";
					}
				}
			// If Array is passed, then it should be for calling method of a Controller class, and also we pass variables in form of key value pair array
			} elseif (is_array($viewName_methodCall)) {
				// echo "<pre>";
				// print_r($viewName_methodCall);
				// echo "</pre>";

				if (is_string($viewName_methodCall[0]) && is_string($viewName_methodCall[1]) && is_array($viewName_methodCall[2])) {
					// echo "First is string<br>";
					// echo "Second is string<br>";
					// echo "Third is Array<br>";
					$arrayClass = $viewName_methodCall[0];
					$arrayMethod = $viewName_methodCall[1];
					$arrayObject = new ($arrayClass);
					// print_r($arrayObject);
					// echo $arrayMethod;
					try {
						extract($viewName_methodCall[2]);
						$arrayObject->{$arrayMethod}();
					} catch (Exception $err) {
						echo $err;
					}
					// print_r($arrayObject->$arrayMethod);
					$isAssociative = array_values($viewName_methodCall[2]) !== $viewName_methodCall[2];

                //
				// 	$num_of_curly_start = substr_count($uri, '{');
				// 	$num_of_curly_end = substr_count($uri, '}');
				// 	// echo "Number of {: " . $num_of_curly_start;
				// 	// echo "<br>Number of }: " . $num_of_curly_end;
                //
				// 	if ($num_of_curly_start == $num_of_curly_end && $num_of_curly_start == 0) {
				// 		// for ($i = 0; $i < $num_of_curly_start; $i++) {
				// 		$cursor = 0;
				// 		for ($i = 0; $i < 2; $i++) {
				// 			echo "<br>";
				// 			$pos_of_start = strpos($uri, 'g', $cursor);
				// 			echo "Start of Word: $pos_of_start <br>";
				// 			$pos_of_end = strpos($uri, 'e', $pos_of_start);
				// 			echo "End of Word: $pos_of_end ";
				// 			$var = substr($uri, $pos_of_start, $pos_of_end - $pos_of_start + 1);
				// 			echo "<br>Extracted: $var";
				// 			$cursor += $pos_of_end - $cursor;
				// 			echo "<br>Cursor Position: $cursor";
				// 			echo "<br>";
				// 		}
				// 	} else {
				// 		//
				// 	}
                //
				// 	// foreach ($brackets as $bracket) {
                //     //
				// 	// }
                //
				// 	// echo "Is Associative: " . (($isAssociative) ? 'True' : 'False');
				// 	if ($isAssociative) {
				// 		extract($viewName_methodCall[2]);
				// 	} else {
				// 		throw new Exception;
				// 	}
				}

			}
		}
	} 


	public static function end() {
>>>>>>> parent of 644502f (Now end method of route is called by deconstructor of Route, means end)
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
