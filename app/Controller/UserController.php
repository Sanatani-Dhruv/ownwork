<?php
namespace App\Controller;

use Dhruv125\Coretex\Viewer\View;

use Dhruv125\Coretex\Support\Request;
use Dhruv125\Coretex\Support\Response;

class UserController {
	function __construct() {
		// Default Controller
	}

	public function index(Request $request, Response $response) {
		$args = $request->getAttribute('dynamicParams');
		$arr = [];

		$arr['id'] = filter_var($args['id'], FILTER_VALIDATE_INT);
		$arr['name'] = filter_var($args['name'], FILTER_SANITIZE_SPECIAL_CHARS);
		$arr['apiKey'] = $request->get('apiKey');
		$arr['apiKey']  = (is_string($arr['apiKey']) && $arr['apiKey'] !== "") ? $arr['apiKey'] : null;

		/* Json Response for API Showcase */
		$response->setHeader('X-Api-Key', $arr['apiKey'] ?? "");
		$response->json($arr);
		$response->dispatch();
		return;
	}
}
