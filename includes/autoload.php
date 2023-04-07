<?php

spl_autoload_register(function ($fullname) {
	$path = explode('\\', $fullname);
	$prefix = array_shift($path);

	if ($prefix === 'TaskStep')
	{
		array_unshift($path, $_SERVER['DOCUMENT_ROOT']);
		require_once implode(DIRECTORY_SEPARATOR, $path) . '.php';
	}
});