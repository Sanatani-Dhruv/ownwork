<?php
namespace App\Middleware;

use Dhruv125\Coretex\Viewer\View;

use Dhruv125\Coretex\Support\Request;
use Dhruv125\Coretex\Support\Response;

class DEFAULT_NAME {
	function __construct() {
		// Default Controller
	}

	public static function handle(Request $request, Response $response, callable $next) {
		return $next();
	}
}
