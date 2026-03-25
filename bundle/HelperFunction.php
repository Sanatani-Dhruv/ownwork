<?php

// Pre-defined Functions By OwnWork

function out($data) {
  return htmlspecialchars($data);
}

function env($data, bool $get = true, $specialChars = true) {
  $data = ($specialChars) ? htmlspecialchars($data) : $data;
  return ($get) ? getenv($data) : putenv($data);
}

function view($string, array $args) {
  \App\Helper\Viewer\View::instantView($string, $args);
}

function url(string $action) {
  $_SERVER['PATH_INFO'] = (!isset($_SERVER['PATH_INFO']) ? '/' : $_SERVER['PATH_INFO']);
  if ($action == 'get') {
    return $_SERVER['PATH_INFO'];
  }

  if ($action == 'getFull') {
    return $_SERVER['REQUEST_URI'];
  }
}

// Function for Getting Instance of Database class if exists - If Someone Uses recommended Package i provided in DB
if (file_exists(__DIR__ . "/../vendor/delight-im/db/src/PdoDataSource.php") && file_exists(__DIR__ . "/../vendor/delight-im/db/src/PdoDatabase.php")) {
  function get_db_instance() {
    $dataSource = new \Delight\Db\PdoDataSource('mysql'); // see "Available drivers for database systems" below
    $dataSource->setHostname(getenv('DB_HOST'));
    $dataSource->setPort(3306);
    $dataSource->setDatabaseName(getenv('DB_NAME'));
    $dataSource->setCharset('utf8mb4');
    $dataSource->setUsername(getenv('DB_USER'));
    $dataSource->setPassword(getenv('DB_PASS'));
    $DB = \Delight\Db\PdoDatabase::fromDataSource($dataSource);
    return $DB;
  }
}
