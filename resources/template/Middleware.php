<?php
namespace App\Middleware;

use App\Viewer\View;

use Dhruv125\Coretex\Support\Request;
use Dhruv125\Coretex\Support\Response;

class DEFAULT_NAME {
	static Request $request; // Request Object
	static Response $response; // Response Object

	function __construct() {
		// Default Middleware
	}

	public static function handle(Request $request, Response $response, callable $next) {
		self::$request = $request;
		self::$response = $response;

		return $next();
	}
}
