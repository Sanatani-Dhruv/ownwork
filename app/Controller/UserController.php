<?php
namespace App\Controller;

use Dhruv125\Coretex\App\Viewer\View;

use Dhruv125\Coretex\Support\Request;
use Dhruv125\Coretex\Support\Response;

class UserController {
	private $args; // This will store Dynamic variables Extracted from url

	private Request $request;
	private Response $response;

	function __construct($dv) {
		$this->args = $dv;
		$this->request = new Request();
		$this->response = new Response();
		// Default Controller
	}

	public function index() {
		$request = &$this->request;
		$response = &$this->response;

		$arr = [];

		$arr['id'] = filter_var($this->args['id'], FILTER_VALIDATE_INT);
		$arr['name'] = filter_var($this->args['name'], FILTER_SANITIZE_SPECIAL_CHARS);
		$arr['apiKey'] = $request->getInput('get', 'apiKey');

		/* Json Response for API Showcase */
		$response->setPayload($arr);
		$response->dispatchJsonPayload(true);
		return;
	}
}
