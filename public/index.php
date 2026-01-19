<?php 

use App\Helper\Environment;
use App\Router\Route;

try {
	require __DIR__ . '/../vendor/autoload.php';

	Environment::setenv();

	$host = getenv('DB_NAME');//returns: localhost
	// echo "Hello World";

	Route::get("/", "main.php");

	Route::get("/welcome", "welcome.php");

	Route::end();
} catch (Exception $err) {
	echo "<pre>$err</pre>";
}

?>
<pre>
<?php
// print_r($_SERVER);
?>
</pre>
