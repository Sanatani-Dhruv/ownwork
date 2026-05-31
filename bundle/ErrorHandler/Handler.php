<?php

class globalErrorHandler {
	private string $systemCompDir;

	public function __construct () {
		$this->systemCompDir = \approot() . "/app/Helper/AppViews/";
		set_error_handler([&$this, 'HandleError']);
		set_exception_handler([&$this, 'HandleException']);
	}

	private function comp(string $compName, array $parameters = []) {
		\comp($compName, $parameters, $this->systemCompDir);
	}

	public function HandleError ($Code, $Message, $File = null, $Line = 0, $Context = []) {
		// echo "Working Error";
		print_r($Message);
		$this->comp("error_layout.php");
		exit;
		// Handle error here.
	}
	private function getTempFileName(string $compiledFile): string {
		if (str_contains($compiledFile,"compiled.php")) {
			$errFile = "";
			$compiledFile = basename($compiledFile);
			if (file_exists(approot() . "/storage/views.json")) {
				$viewArr = json_decode(file_get_contents(approot() . "/storage/views.json"), true);
				foreach($viewArr as $key => $value) {
					if ($value == $compiledFile) {
						$errFile = $key;
					}
				}
				if ($errFile === "") {
					return $compiledFile;
				} else {
					return $errFile;
				}
			} else {
				return $compiledFile;
			}
		} else {
			return $compiledFile;
		}
	}

	private function printTracePath(&$Exception) {
		$traceBlockArr = array();
		foreach($Exception->getTrace() as $trace) {
			$traceContainer = "";
			$fileContent = fopen($trace["file"], "r");
			$traceContainer .= "<pre class='file_content overflow-auto hidden'>";
			$i = 0;

			while ($line = fgets($fileContent)) {
				$i++;
				if (!trim($line) !== "") {
					if (($trace["line"] >= $i - 4 && $trace["line"] < $i+5)) {
						if ($trace['line'] === $i) {
							$traceContainer .= "<div class='text-red-500/100'><strong><em>";
							$traceContainer .= "$i ";
							$traceContainer .= out($line);
							$traceContainer .= "</strong></em></div>";
						} else {
							$traceContainer .= "<div>";
							$traceContainer .= "$i ";
							$traceContainer .= out($line);
							$traceContainer .= "</div>";
						}
					}
				}
			}
			$traceContainer .= "</pre>";
			// print_r($trace);
			$traceBlockArr[] = $traceContainer;
			$traceContainer = "";
			fclose($fileContent);
		}
		return $traceBlockArr;
	}

	public function HandleException($Exception) {
		try {
			http_response_code(500);
			$traceBlockArr = null;
			// echo "!!Working Exception!!";

			if ($Exception->getTrace()) {
				$traceBlockArr = $this->printTracePath($Exception);
			}
			// echo "<pre>";
			// print_r(get_class_methods($Exception));
			// echo "</pre>";

			$errFile = $this->getTempFileName($Exception->getFile());

			/* Remove System dir Prefix which is app directory */
			$errFile = (str_contains($errFile, approot()) ? str_replace(approot() . "/", "", $errFile) : $errFile);

			$errLine = $Exception->getLine();

			$this->comp("error_layout.php", [
				"errMsg" => $Exception->getMessage(),
				"errFile" => $errFile,
				"errLine" => $errLine,
				"traceBlocksArr" => $traceBlockArr,
				"syscompdir" => $this->systemCompDir,
				"tracePathArr" => $Exception->getTrace()
			]);
			exit();

			// Handle exception here.
		} catch (\Exception $err) {
			echo $err;
		}
	}
};

$handler = new globalErrorHandler();
