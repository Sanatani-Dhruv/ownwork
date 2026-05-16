#!/usr/bin/env php
<?php

function approot() {
	return dirname(__DIR__ . "/Template.php",4);
}

class Template {
	private array $filePathArr;
	private array $filemTimeArr;

	function __construct() {
		$this->filePathArr = array();
		$this->filemTimeArr = array();
	}

	public function parse(string $filename): string {
		if (!file_exists($filename))
			throw new \ErrorException("File $filename not found");

		$start = file_get_contents($filename);

		/* PHP Block */
		$final = str_replace("@php", "<?php", $start);
		$final = str_replace("@endphp", "?>", $final);

		$final = str_replace(")@", ");?>", $final);

		/* If Block */
		$final = str_replace("@if(", "<?php if(", $final);
		$final = str_replace("):>", ") :", $final);
		$final = str_replace("):", "):?>", $final);
		$final = str_replace("@endif;", "<?php endif;?>", $final);
		$final = str_replace("@elseif(", "<?php elseif(", $final);

		/* For Block */
		$final = str_replace("@for(", "<?php for(", $final);
		$final = str_replace("@endfor;", "<?php endfor;?>", $final);

		/* Foreach Block */
		$final = str_replace("@foreach(", "<?php foreach(", $final);
		$final = str_replace("@endforeach;", "<?php endforeach;?>", $final);

		/* Echo Block */
		$final = str_replace("{{", "<?=htmlspecialchars(", $final);
		$final = str_replace("}}", ")?>", $final);
		$final = str_replace("{!{", "<?=(", $final);
		$final = str_replace("}!}", ")?>", $final);

		/* While Block */
		$final = str_replace("@while(", "<?php while(", $final);
		$final = str_replace("@endwhile;", "<?php endwhile; ?>", $final);

		/* Do While Block */
		$final = str_replace("@dowhile:", "<?php do{ ?>", $final);
		$final = str_replace("@enddowhile(", "<?php }while(", $final);

		/* Switch Block */
		$final = str_replace("@switch(", "<?php switch(", $final);
		$final = str_replace("@fcase(", "case (", $final);
		$final = str_replace("@case(", "<?php break;case(", $final);
		$final = str_replace("@default:", "<?php break;default:?>", $final);
		$final = str_replace("@endswitch;", "<?php break;endswitch;?>", $final);

		return $final;
	}

	public function checkMTime(string $filePath, string $json) {
		if (!file_exists($filePath)) {
			touch($filePath);
		}
		$array = json_decode($json);
		echo "Main File: $filePath\n";
		foreach ($array as $file => $time) {
			echo "$file => $time\n";
			if ($file === $filePath && filemtime($file) === $time) {
				echo "True";
			}
		}
	}

	public function scan(string $dirPath, string $storageDirPath) {
		if (!is_dir($storageDirPath)) {
			throw new \ErrorException("Given Path '$storageDirPath' is not a Directory");
		}

		if (is_dir($dirPath)) {
			$dirList = scandir($dirPath);
			// print_r($dirList);
			foreach($dirList as $value) {
				if ($value == "." || $value == "..")
					continue;
				// echo $dirPath . "/" .$value . "\n";
				$this->scan($dirPath . "/" . $value, $storageDirPath);
			}
		} elseif(is_file($dirPath)) {
			if (strstr($dirPath, ".temp.php") && !strstr($dirPath, "compiled.")) {
				$fileName = rand(1000000,9999999) . ".compiled.php";
				$this->filePathArr[$dirPath] = $fileName;
				$this->filemTimeArr[$dirPath] = filemtime($dirPath);
			}
		}
		if (count($this->filePathArr))
			return $this->filePathArr;
		else
			return null;
	}

	public function giveMTimeArr() {
		return $this->filemTimeArr;
	}
}

$viewStorage = approot() . "/storage/views/";
$viewRes = approot() . "/resources/views/";
$parser = new Template();
$str = $parser->parse(approot() . "/resources/views/main.temp.php");
$arr = $parser->scan($viewRes, $viewStorage);
$json = json_encode($arr);
print_r($mtime);
// $parser->checkMTime(__DIR__ . "/index.temp.php", $json);
$mtime = json_encode($parser->giveMTimeArr());
file_put_contents("mtime.json", $mtime);

// echo "Array: ";
// print_r($arr);
// $json = json_encode($arr);
// echo "Json: $json";
// file_put_contents("list.json", $json);

// file_put_contents("index.temp.php", $str);
