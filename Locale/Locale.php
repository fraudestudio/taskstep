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

		define('l', new Locale($config->language(), $data));
	}

	private array $_text = [];
	private string $_language;

	private function __construct(string $language, array $data)
	{
		$this->_language = $language;

		// transforme les sections en objets Locale
		foreach ($data as $key => $item)
		{
			if (is_array($item) && !array_is_list($item))
			{
				$this->_text[$key] = new Locale($language, $item);
			}
			else
			{
				$this->_text[$key] = $item;
			}
		}
	}

	public function __get(string $property)
	{
		return $this->_text[$property] ?? new Missing;
	}

	public function language(): string { return $this->_language; }
}

class Missing
{
	public function __get(string $property) { return $this;	}

	public function __toString() { return '<em>&lt;missing translation&gt;</em>'; }
}