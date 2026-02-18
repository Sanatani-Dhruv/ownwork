<?php

namespace Bundle\Environment;

class Environment {
  # Set Environmental variables

  # Path Compared to this directory

  public static function setenv() {
    require __DIR__ . "/DotEnvironment.php";
    $dotEnvironment = new DotEnvironment(__DIR__ . "/../../.env");
    echo "<pre>";
    print_r($_ENV);
    echo "</pre>";

    $dev_env = ($_ENV["DEV_ENV"] == 'true') ? true : false;

    if ($dev_env) {
      ini_set('display_errors', '1');
      ini_set('display_startup_errors', '1');
      error_reporting(E_ALL);
    }
  }
}

?>
