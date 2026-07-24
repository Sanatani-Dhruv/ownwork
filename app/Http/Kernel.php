<?php

namespace App\Http;

use Dhruv125\Coretex\Router\Route;
use Dhruv125\Coretex\Router\RouteResolver;
use Dhruv125\Coretex\Pager;

use Dhruv125\Coretex\Exceptions\InternalErrorException;
use Dhruv125\Coretex\Exceptions\PageNotFoundException;
use Dhruv125\Coretex\Exceptions\ViewNotFoundException;
use Dhruv125\Coretex\Exceptions\ViewsDotJsonNotFoundException;

use Dhruv125\Coretex\Support\Request;
use Dhruv125\Coretex\Support\Response;

class Kernel {
    private Route $route;
    private RouteResolver $resolver;
    private Request $request;
    private Response $response;
    private Pager $pager;

    public function __construct() {
        $this->request = new Request();
        $this->response = new Response();
        $this->route = new Route($this->request, $this->response);
        $this->resolver = new RouteResolver();

		// Initialize Error Displayer
		$this->pager = new Pager();
    }

    private function runMiddlewares(array $middlewares, int $index, array $args, callable $dispatcher) {
        if (!isset($middlewares[$index])) {
            return $dispatcher(...$args);
        }

        $middleware = $middlewares[$index];

        return $middleware(
            ...[
                ...$args,
                function() use ($middlewares, $index, &$args, $dispatcher) {
                    return $this->runMiddlewares($middlewares, $index + 1, $args, $dispatcher);
                },
            ]
        );
    }

    public function handle() {
        try {
            $route = $this->route;
            $resolver = $this->resolver;

            /* Registering Routes */
            require_once(approot() . "/bundle/Routes.php");
            /* Getting Match for Url and it's handlers */
            $result = $route->end();

            /* Local Storage */
            $middlewares = $result['middlewares'] ?? [];
            $dynamicParams = $result['params'] ?? [];

            /* Middleware will run this if all middleware ran $next() method */
            $dispatcher = function ($request, $response) use ($result, $resolver) {
                $handler = $result['handler'] ?? null;
                $dynamicParams = $result['params'] ?? [];
                if ($handler === null) {
                    throw new PageNotFoundException("Page Not Found");
                }
                /* Calling Resolver after all */
                return $resolver->resolve($handler, $request, $response);
            };

            $globalMiddleware = array_reverse($this->route->getGlobalMiddleware());

            foreach($globalMiddleware as $middleware) {
                if (array_key_exists('class', $middleware)) {
                    [ 'class' => $className, 'method' => $methodName ] = $middleware;
                    $handler = [$className, $methodName];
                } else {
                    [ 'handler' => $handler ] = $middleware;
                }
                array_unshift($middlewares, $handler);
            }
            $this->request->setAttribute('currentRoute', $result['currentRoute'] ?? '/');
            $this->request->setAttribute('dynamicParams', $dynamicParams);

            $finalResponse = $this->runMiddlewares($middlewares, 0, [
                $this->request,
                $this->response,
            ],
            $dispatcher);

            if (is_string($finalResponse)) {
                $this->response->setBody($finalResponse);
                $this->response->dispatch();
            }

            if (is_object($finalResponse) && get_class($finalResponse) === Response::class) {
                $finalResponse->dispatch();
            }

		} catch (PageNotFoundException $err) {
			http_response_code(404);
			$this->pager->notFoundPage();
		} catch (ViewNotFoundException $err) {
			http_response_code(500);
			$this->pager->viewNotFoundPage($err->viewName);
        }
    }
}
