<?php

namespace Bundle\RateLimiter;

class Limiter {
	private string $storageDir;
	private string $cacheDbDir;
	private string $cacheDbName;
	private string $cacheDbPath;
	private string $totalRequest;
	private string $ipAdd;
	private int $timeLimit;

	function __construct () {
		// echo "Limiter Created<br>";
		$this->ipAdd = $_SERVER["REMOTE_ADDR"];
		$this->storageDir = approot() . "/storage/";
		$this->cacheDbDir = approot() . "/storage/cache/";
		$this->cacheDbName = "limiter.db";
		$this->cacheDbPath = approot() . "/storage/cache/" . $this->cacheDbName;
	}

	public function setTimeLimit(int $timeInMinute) {
		$this->timeLimit = $timeInMinute * 60;
	}

	public function setTimeLimitInSec(int $timeInSec) {
		$this->timeLimit = $timeInSec;
	}

	public function getIp() : string {
		return $this->ipAdd;
	}

	public function status(bool | int $status) {
		if ($status) {
			$this->check();
		}
	}

	public function makeCacheDbDir() : bool {
		if (!is_dir($this->cacheDbDir)) {
			if (!is_dir(approot() . "/storage/")) {
				mkdir(approot() . "/storage/");
			}
			mkdir(approot() . "/storage/cache/");
			return true;
		}
		return true;
	}

	public function getCacheDb() {
		if ($this->makeCacheDbDir()) {

		}
	}

	public function check() {
		$this->getCacheDb();
		// echo "Limiter Started<br>";
		// echo $this->ipAdd;
	}
}
