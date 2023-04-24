<?php

declare(strict_types=1);

namespace TaskStep;

class Styles
{
	public static function available(): array
	{
		$result = [];

		$stylesDir = dir(Self::joinPath($_SERVER['DOCUMENT_ROOT'], 'styles'));
		while($item = $stylesDir->read())
		{
			$itemPath = Self::joinPath($stylesDir->path, $item);
			if (is_file($itemPath) && str_ends_with($item, '.css'))
			{
				$name = explode('.', $item)[0];
				array_push($result, $name);
			}
		}
		$stylesDir->close();

		return $result;
	}

	private static function joinPath(string ...$parts): string
	{
		return implode(DIRECTORY_SEPARATOR, $parts);
	}
}