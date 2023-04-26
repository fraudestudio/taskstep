<?php

declare(strict_types=1);

namespace TaskStep\Middleware\Helpers;

interface JsonSerializable extends \JsonSerializable
{
	public function jsonDeserialize(mixed $value) : void;
}