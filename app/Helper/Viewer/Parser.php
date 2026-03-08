<?php
namespace App\Helper\Viewer;

use App\Helper\Router\Route;

class Parser {
	static $fileContent;
	static $compiledLocation = __DIR__ . "/../../../storage/views/";
	static $srcLocation = __DIR__ . "/../../../resources/views/";
	function __construct() {
		echo "Hi";
	}

	static function fExist() {
		if (file_exists(self::$compiledLocation)) {
			return true;
		} else {
			mkdir(self::$compiledLocation, 0777, true);
			return true;
		}
		return false; 
	}

	static function Parse(string $viewName, string $fileLocation) {
		$fileName = $fileLocation . $viewName;
		$fileContent = '';
		if (str_contains($viewName, "temp.php")) {
			$handler = file($fileName);
			$i = 0;
			while (count($handler) > $i) {
				$line = $handler[$i];
				// echo $line. "<br>";

				// For Handling @php and @endphp
				if (str_contains($line, trim('@php '))) {
					$line = str_replace(trim('@php '), '<?php ', $line);
				}
				if (str_contains($line, trim('@endphp '))) {
					$line = str_replace(trim('@endphp '), ' ?>', $line);
				}

				// For Handling {{ and }}
				if (str_contains($line, trim('{{ '))) {
					$line = str_replace(trim('{{'), '<?=out(', $line);
				}
				if (str_contains($line, trim('}}'))) {
					$line = str_replace(trim('}}'), ')?>', $line);
				}
				// echo ($line);
				// echo "<pre>";
				$fileContent .= $line;
				// echo "</pre>";
				$i++;
			}

			$srcFileName = $fileName;
			// echo $fileContent;
			$fileLocation = __DIR__ . "/../../../storage/views/";
			$viewName = str_replace('.temp.php', '.php', $viewName);
			echo $fileLocation . "COMPILED_" . $viewName;
			$fileName = $fileLocation . "COMPILED_" . $viewName;
			if (!self::fExist()) {
				die();
			}
			$srcFileTime = filemtime($srcFileName);
			if (file_exists(self::$compiledLocation . $viewName)) {
			$fileTime = filemtime($fileName);
			} else {
				touch($fileName);
				$fileTime = true;
			}
			$diffTime = $fileTime - $srcFileTime;
			if (!$diffTime < 1000) {
				file_put_contents($fileName, $fileContent);
				require $fileName;
			}

			echo "<br><br>========================================================================================<br><br>";
		}
	}
}
