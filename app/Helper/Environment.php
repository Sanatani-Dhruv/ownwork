<?php 

namespace App\Helper;

class Environment {
  # Set Environmental variables

  # Path Compared to this directory

  public static function setenv() {

    $filepath = __DIR__ . '/../../.env';
    $env = file_get_contents($filepath);
    $lines = explode("\n",$env);

    foreach($lines as $line){
      preg_match("/([^#]+)\=(.*)/",$line,$matches);
      if(isset($matches[2])){ putenv(trim($line)); }
    } 
  }

}

?>
