#!/usr/bin/env php
<?php

require __DIR__ . "/app/Helper/ConsoleHelper.php";
use App\Helper\ConsoleHelper;

$printer = new ConsoleHelper();

function help() {
	echo 'Usage: php worker [OPTION]...
Executing Commands for easy components management - OwnWork

OPTIONS:
make - Making Components, it arguments:
    > controller - Make Controller File
    > model - Make Model File
    > view - Make View File
';
}

// print_r($argv);
// echo "\n";
$dirArray = [
	'controller' => __DIR__ . "/app/Controller/",
	'view' => __DIR__ . "/resources/views/",
	'model' => __DIR__ . "/app/Model/"
];

$baseDirArray = [
	'controller' => "app/Controller/",
	'view' => "resources/views/",
	'model' => "app/Model/"
];

$baseFileArray = [
	'controller' => __DIR__ . "/app/Helper/Controller.php",
	'view' => __DIR__ . "/app/Helper/View.php",
	'model' => __DIR__ . "/app/Helper/Model.php"
];

$firstarg = (isset($argv[1])) ? $argv[1] : false;

foreach ($dirArray as $key => $value) {
	if (!is_dir($value)) {
		mkdir($value, 0664);
	}
}

if ($firstarg && $argv[1] == 'make') {
	if (isset($argv[2])) {
		$dirName = strtolower($argv[2]);
		switch ($dirName) {
		case 'controller':
			$value = (isset($argv[3])) ? $argv[3] : trim(readline('Enter Controller Name: '));
			touch($dirArray[$dirName] . $value . ".php");
			file_put_contents($dirArray[$dirName]. $value . ".php", file_get_contents($baseFileArray[$dirName]));
			echo "\nController with name `$value.php` created at: \n\n";
			echo "-> " . $baseDirArray[$dirName] . $value . ".php\n";
			break;
		case 'model':
			$dirName = 'modelDir';
			$value = (isset($argv[3])) ? $argv[3] : trim(readline('Enter Model Name: '));
			touch($dirArray[$dirName] . $value . ".php");
			file_put_contents($dirArray[$dirName]. $value . ".php", file_get_contents($baseFileArray[$dirName]));
			echo "\nModel with name $value.php created at: \n";
			echo "-> " . $baseDirArray[$dirName] . $value . ".php\n";
			break;
		case 'view':
			$dirName = 'viewDir';
			$value = (isset($argv[3])) ? $argv[3] : trim(readline('Enter View Name: '));
			touch($dirArray[$dirName] . $value . ".php");
			file_put_contents($dirArray[$dirName]. $value . ".php", file_get_contents($baseFileArray[$dirName]));
			echo "\nView with name $value.php created at: \n";
			echo "-> " . $baseDirArray[$dirName] . $value . ".php\n";
			break;
		default:
			echo "No Such Component Exists\n\n";
			help();
			break;
		}
	} else {
		echo "Provide Name of Component to make!\n\n";
		help();
	}
}

if (!$firstarg) {
	help();
}

