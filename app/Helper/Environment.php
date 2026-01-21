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
      // echo preg_match("/([^#]+)\=(.*)/",$line,$matches);
      if(preg_match("/([^#]+)\=(.*)/", $line, $matches)) {
        // echo $line;
        $remove[] = '"';
        $remove[] = "'";
        putenv(trim($line));
      }
    } 
  }

}

?>
