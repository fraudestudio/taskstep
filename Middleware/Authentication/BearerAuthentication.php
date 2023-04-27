<?php

declare(strict_types=1);

namespace TaskStep\Middleware\Authentication;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use TaskStep\Middleware\Helpers\Services;
use TaskStep\Logic\Model\User;

class BearerAuthentication
{
	public function __invoke(Request $request, RequestHandler $handler) : Response
    {
        $failed = (new \Slim\Psr7\Response())
            ->withStatus(401)
            ->withHeader('WWW-Authenticate', 'Bearer');

        $authHeader = $request->getHeader('Authorization');

        if (count($authHeader) == 0) return $failed;

        list($authScheme, $authData) = explode(' ', $authHeader[0], 2);

        if ($authScheme != 'Bearer') return $failed;

        $userDao = Services::instance()->get('userDao');
        try
        {
            $user = $userDao->readBySessionToken($authData);
            $userDao->refreshSession($authData);

            $request = $request->withAttribute('user', $user);
            return $handler->handle($request);
        }
        catch (NotFoundException|TokenOutOfDateException)
        {
            return $failed;
        }
    }
}