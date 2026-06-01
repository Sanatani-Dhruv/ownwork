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

	public function HandleError($Code, $Message, $File = null, $Line = 0, $Context = []) {
		// echo "Working Error";
		print_r($Message);
		$this->comp("error_layout.php");
		exit;
		// Handle error here.
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
							$traceContainer .= "<div class='text-red-500/100'>";
							$traceContainer .= "$i ";
							$traceContainer .= out($line);
							$traceContainer .= "</div>";
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

	public function HandleException ($Exception) {
		try {
			$traceBlockArr = null;
			// echo "!!Working Exception!!";

			if ($Exception->getTrace()) {
				$traceBlockArr = $this->printTracePath($Exception);
			}
			// echo "<pre>";
			// print_r(get_class_methods($Exception));
			// echo "</pre>";

			$this->comp("error_layout.php", [
				"errMsg" => $Exception->getMessage(),
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
