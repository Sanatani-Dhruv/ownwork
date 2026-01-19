<?php 

use App\Helper\Environment;
use Bundle\Bundler;

try {
	require __DIR__ . '/../vendor/autoload.php';

	Environment::setenv();

	// Bundler class bundles your application with routes and other neccesary things
	// $bundle = new Bundler();
	Bundler::bundle();
} catch (Exception $err) {
	echo "<pre>$err</pre>";
}
