<?php
namespace App\Controller;

use App\Viewer\View;

class DEFAULT_NAME {
	private $args; // This will store Dynamic variables Extracted from url
	function __construct($dynaVar) {
		$this->args = $dynaVar;
		// Default Controller
	}

	public function index() {
		// Base Method
	}
}
