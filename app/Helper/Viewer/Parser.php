<?php
namespace App\Helper\Viewer;

use App\Helper\Router\Route;

class Parser {
	protected $fileContent;
	function __construct() {
		echo "Hi";
	}

	static function Parse(string $fileLocation, string $viewName) {
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
			$srcFileTime = filemtime($srcFileName);
			$fileTime = filemtime($fileName);
			$diffTime = $fileTime - $srcFileTime;
			if (!$diffTime < 1000) {
				touch($fileName);
				file_put_contents($fileName, $fileContent);
				require $fileName;
			}

			echo "<br><br>========================================================================================<br><br>";
		}
	}
}
