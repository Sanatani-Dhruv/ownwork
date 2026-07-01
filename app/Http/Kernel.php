<?php

namespace App\Http;

use Dhruv125\Coretex\Router\Route;
use Dhruv125\Coretex\Router\RouteResolver;

use Dhruv125\Coretex\Exceptions\InternalErrorException;
# More PageNotFoundException ViewJsonNotFoundException ViewNotFoundException

use Dhruv125\Coretex\Support\Request;
use Dhruv125\Coretex\Support\Response;

class Kernel {
    private Route $route;
    private RouteResolver $resolver;
    private Request $request;
    private Response $response;

    public function __construct() {
        $this->route = new Route();
        $this->resolver = new RouteResolver();
        $this->request = new Request();
        $this->response = new Response();
    }

    public function handle() {
        try {
            $route = $this->route;
            require_once(approot() . "/bundle/Routes.php");
            $result = $route->end();
            pre($result);

			// $route->runMiddleware($request, $handler, $keyPair);
            //
        } catch (Exception $err) {
        }
    }
}
