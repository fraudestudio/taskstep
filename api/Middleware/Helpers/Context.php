<?php

declare(strict_types=1);

namespace TaskStepApi\Middleware\Helpers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Context
{
	private Request $_request;
	private Response $_response;
	private array $_urlArgs;

	public function __construct(Request $request, Response $response, array $urlArgs) {
		$this->_request = $request;
		$this->_response = $response;
		$this->_urlArgs = $urlArgs;
	}

	public function request(): Request { return $this->_request; }

	public function response(): Response { return $this->_response; }

	public function setResponse(callable $callback) {
		$this->_response = $callback($this->_response);
	}

	public function urlArg(string $arg): ?string { return $this->_urlArgs[$arg] ?? null; }
}