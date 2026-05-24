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

	private function printTracePath(&$Exception) {
		foreach($Exception->getTrace() as $trace) {
			$this->comp("stackTrace-block.php", [
				"filePath" => $trace["file"]
			]);

			$fileContent = fopen($trace["file"], "r");
			echo "<pre>";
			$i = 0;

			while ($line = fgets($fileContent)) {
				$i++;
				if (!trim($line) !== "") {
					if (($trace["line"] >= $i - 4 && $trace["line"] < $i+5)) {
						if ($trace['line'] === $i) {
							echo "<div class='text-red-500/100'>";
							echo "$i ";
							echo out($line);
							echo "</div>";
						} else {
							echo "$i ";
							echo out($line);
						}
					}
				}
			}
			echo "</pre>";
			// print_r($trace);
			echo "<br>";
			fclose($fileContent);
		}
	}

	public function HandleException ($Exception) {
		try {
			// echo "!!Working Exception!!";
			$this->comp("error_layout.php", [
				"errMsg" => $Exception->getMessage()
			]);

			if ($Exception->getTrace()) {
				$this->printTracePath($Exception);
			}
			// echo "<pre>";
			// print_r(get_class_methods($Exception));
			// echo "</pre>";

			exit();
			// Handle exception here.
		} catch (\Exception $err) {
			echo $err;
		}
	}
};

$handler = new globalErrorHandler();
