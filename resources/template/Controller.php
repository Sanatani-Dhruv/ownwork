<?php
namespace App\Controller;

use App\Viewer\View;

use Coretex\Support\Request;
use Coretex\Support\Response;

class DEFAULT_NAME {
	private $args; // This will store Dynamic variables Extracted from url

	private Request $request; // Request Object
	private Response $response; // Response Object

	function __construct($dv) {
		$this->args = $dv;
		$this->request = new Request();
		$this->response = new Response();
		// Default Controller
	}

	public function index() {
		$request = &$this->request;
		$response = &$this->response;
	}
}
