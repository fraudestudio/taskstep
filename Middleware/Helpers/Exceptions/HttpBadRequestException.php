<?php

declare(strict_types=1);

namespace TaskStep\Middleware\Helpers\Exceptions;

use Psr\Http\Message\ServerRequestInterface as Request;

class HttpBadRequestException extends \Slim\Exception\HttpBadRequestException
{
    public function __construct(Request $request, string $customMessage)
    {
        parent::__construct($request);

        $this->message = $customMessage;
    }
}
