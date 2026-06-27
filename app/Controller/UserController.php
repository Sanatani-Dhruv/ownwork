<?php
namespace App\Controller;

use App\Viewer\View;

use Coretex\Support\Request;
use Coretex\Support\Response;

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

		$arr = [
			'key' => 'buzz',
			'value' => 'wow',
			'reasone' => 'none',
		];

		$response->setPayload("array", $arr);
		$response->dispatchJsonPayload(true);
	}
}
