<?php

declare(strict_types=1);

namespace TaskStep\Locale;

use TaskStep\Config;

class Locale
{
	public static function load()
	{
		$config = Config::instance()->locale();
		$path = [$_SERVER['DOCUMENT_ROOT'], 'Locale', 'lang', "{$config->language()}.php"];

		$data = require implode(DIRECTORY_SEPARATOR, $path);
		$data['dateFormat']['menu'] = $config->menuDateFormat();
		$data['dateFormat']['task'] = $config->taskDateFormat();

		define('l', new Locale($data));
	}

	private array $_text;

	private function __construct(array $data)
	{
		// transforme les sections en objets Locale
		$this->_text = array_map(
			function ($item) { return (is_array($item) && !array_is_list($item)) ? new Locale($item) : $item; },
			$data
		);
	}

	public function __get(string $property)
	{
		return $this->_text[$property];
	}
}