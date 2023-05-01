<?php

declare(strict_types=1);

namespace TaskStepApi\Middleware\Helpers;

interface JsonSerializable extends \JsonSerializable
{
	public function jsonDeserialize(mixed $value) : void;
}