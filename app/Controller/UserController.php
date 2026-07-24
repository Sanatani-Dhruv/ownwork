<?php
namespace App\Controller;

use Dhruv125\Coretex\App\Viewer\View;

use Dhruv125\Coretex\Support\Request;
use Dhruv125\Coretex\Support\Response;

class UserController {
	private $args; // This will store Dynamic variables Extracted from url

	private Request $request;
	private Response $response;

	function __construct() {
		// Default Controller
	}

	public function index(Request $request, Response $response) {
		$this->args = $request->getAttribute('dynamicParams');

		$arr = [];

		$arr['id'] = filter_var($this->args['id'], FILTER_VALIDATE_INT);
		$arr['name'] = filter_var($this->args['name'], FILTER_SANITIZE_SPECIAL_CHARS);
		$arr['apiKey'] = $request->get('apiKey');
		$arr['apiKey']  = (is_string($arr['apiKey']) && $arr['apiKey'] !== "") ? $arr['apiKey'] : null;

		/* Json Response for API Showcase */
		$response->setHeader('X-Api-Key', $arr['apiKey'] ?? "");
		$response->json($arr);
		return $response;
	}
}
