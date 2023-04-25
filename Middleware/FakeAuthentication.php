<?php

declare(strict_types=1);

namespace TaskStep\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use TaskStep\Logic\Model\User;

class FakeAuthentication
{
	public function __invoke(Request $request, RequestHandler $handler) : Response
    {
        $request = $request->withAttribute('user', new User(1000));
    
        return $handler->handle($request);;
    }
}