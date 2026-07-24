<?php
namespace App\Controller;

use App\Viewer\View;

use Dhruv125\Coretex\Support\Request;
use Dhruv125\Coretex\Support\Response;

class DEFAULT_NAME {
	private $args; // This will store Dynamic variables Extracted from url

	private Request $request; // Request Object
	private Response $response; // Response Object

	function __construct($dv) {
		$this->args = $dv;
		// Default Controller
	}

	public function index(Request $request, Response $response) {

	}
}
