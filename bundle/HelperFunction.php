<?php

// Pre-defined Functions By OwnWork

function out($data) {
  return htmlspecialchars($data);
}

function env($data, bool $get = true, bool $specialChars = true) {
  $data = ($specialChars) ? htmlspecialchars($data) : $data;
  return ($get) ? getenv($data) : putenv($data);
}

function view($string, array $args = []) {
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
  if (env("DB_DRIVER") == "sql") {
    function get_db_instance() {
      $dataSource = new \Delight\Db\PdoDataSource(PDO_SQLITE); // see "Available drivers for database systems" below
      $dataSource->setHostname(env('DB_HOST'));
      $dataSource->setPort(3306);
      $dataSource->setDatabaseName(env('DB_NAME'));
      $dataSource->setCharset('utf8mb4');
      $dataSource->setUsername(env('DB_USER'));
      $dataSource->setPassword(env('DB_PASS'));
      $DB = \Delight\Db\PdoDatabase::fromDataSource($dataSource);
      return $DB;
    }
  }
  if (env("DB_DRIVER") == 'sqlite') {
    function get_db_instance() {
      $dbDir = __DIR__ . "/../storage/db";
      $dbName = env("DB_NAME") . ".db";
      $dbFilePath = "$dbDir/$dbName";
      echo $dbFilePath;

      // Creating sqlite file if not exists
      if (!is_dir($dbDir)) {
        mkdir($dbDir, 0777, true);
      }
      if (!file_exists($dbFilePath)) {
        touch($dbFilePath);
      }

      $pdo = new PDO("sqlite:$dbFilePath");
      $DB = \Delight\Db\PdoDatabase::fromPdo($pdo);
      return $DB;
    }
  }
}
