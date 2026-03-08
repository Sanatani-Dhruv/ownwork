<?php
namespace App\Helper\Viewer;

use App\Helper\Router\Route;

class Parser {
	static $compiledLocation = __DIR__ . "/../../../storage/views/";
	static $srcLocation = __DIR__ . "/../../../resources/views/";

	private $srcViewName;
	private $compiledViewName;

	private $srcFileName;
	private $compiledFileName;

	private $fileContent;
	private $handler;

	public function __construct(string $srcViewName = '') {
		if (self::dExist() && $srcViewName != '') {
			$this->srcViewName = $srcViewName;
			$this->srcFileName = self::$srcLocation . $this->srcViewName;
			$this->compiledViewName = "__COMPILED__$this->srcViewName";
			$this->compiledFileName = self::$compiledLocation . $this->compiledViewName;
			$this->handler = file($this->srcFileName);
		}
	}

	public function putViewName(string $srcViewName) {
		$this->fExist($srcViewName);
		$this->srcViewName = $srcViewName;
		$this->srcFileName = self::$srcLocation . $this->srcViewName;
		$this->compiledViewName = "__COMPILED__$this->srcViewName";
		$this->compiledFileName = self::$compiledLocation . $this->compiledViewName;
	}

	private function fillCompiledFile() {
		file_put_contents($this->compiledFileName, $this->fileContent);
	}

	static function dExist() {
		if (file_exists(self::$compiledLocation)) {
			return true;
		} else {
			mkdir(self::$compiledLocation, 0777, true);
			return true;
		}
		return false; 
	}

	public function checkEnv() {
		if (env('VIEW_CACHE')) {
			echo 'yes';
		}
	}

	public function fExist($fileName) {
		if (self::dExist() && file_exists(self::$compiledLocation . $fileName)) {
			return true;
		} else {
			touch (self::$compiledLocation . $fileName);
			return true;
		}
		return false;
	}

	private function loadCompiledFile() {
		// echo $this->compiledFileName;
		if (file_exists($this->compiledFileName)) {
			require $this->compiledFileName;
		} else {
			echo "<h3 style='color: crimson;'>No Compiled File Found as <code>$this->compiledFileName</code></h3>";
			http_response_code(404);
			throw new \ErrorException("No Compiled File Found as $this->compiledFileName");
			// die();
		}
	}

	function Parse() {
		$this->fileContent = '';
		// echo "Source File Name: $this->srcFileName";
		if (str_contains($this->srcViewName, "temp.php")) {
			$this->handler = file($this->srcFileName);
			$i = 0;
			while (count($this->handler) > $i) {
				$line = $this->handler[$i];
				// echo $line. "<br>";

				// For Handling @php and @endphp
				if (str_contains($line, '@php ')) {
					$line = str_replace('@php ', '<?php ', $line);
				}
				if (str_contains($line, '@endphp ')) {
					$line = str_replace('@endphp ', ' ?>', $line);
				}

				// For Handling {{ and }}
				if (str_contains($line, '{{ ')) {
					$line = str_replace('{{', '<?=out(', $line);
				}
				if (str_contains($line, '}}')) {
					$line = str_replace('}}', ')?>', $line);
				}

				// echo ($line);
				// echo "<pre>";
				$this->fileContent .= $line;
				// echo "</pre>";
				$this->fillCompiledFile();

				$i++;
			}
			$this->checkEnv();
			return $this->compiledFileName;
			// echo $this->compiledFileName;
			// echo "<br><br>========================================================================================<br><br>";
		} else {
			$this->checkEnv();
			$this->fileContent = file_get_contents($this->srcFileName);
			$this->fillCompiledFile();
			return $this->compiledFileName;
		}
	}
}
