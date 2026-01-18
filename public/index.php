<?php 

require __DIR__ . '/../vendor/autoload.php';

use App\Helper\Environment;
use App\Router\Route;

Environment::setenv();

$host = getenv('DB_NAME');//returns: localhost
// echo "Hello World";

Route::get("/", "index.php");


?>
<pre>
<?php
// print_r($_SERVER);
?>
</pre>
