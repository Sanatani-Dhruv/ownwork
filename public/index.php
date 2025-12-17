<?php 

use App\Helper\Environment;

require __DIR__ . '/../vendor/autoload.php';

Environment::setenv();

$host = getenv('DB_NAME');//returns: localhost
echo $host;

// print_r($_SERVER);

?>
