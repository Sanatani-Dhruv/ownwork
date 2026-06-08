<?php 
ob_start();
use Bundle\Bundler;

// require(__DIR__ . "/../bundle/ErrorHandler/Handler.php");

require __DIR__ . "/../bundle/Bundler.php";
// Bundler class bundles your application with routes and other neccesary things
$app = new Bundler();
$app->bundle(); // Starting our app
ob_end_flush();
