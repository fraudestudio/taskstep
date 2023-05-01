<?php

require_once "autoload.php";

session_start();  
header("Cache-control: private");

if(!$_SESSION['loggedin'] ?? false)
{
	$host  = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/');
	$then = rawurlencode(ltrim($_SERVER['REQUEST_URI'], '/'));
	session_write_close();
	if ($then === '')
	{
		// redirection ver l'app angular si l'utilisateur arrive sur le site
		header("Location: http://$host$baseUri/app/login");
	}
	else
	{
		header("Location: http://$host$baseUri/login.php?then=$then");
	}
	exit;
}

define('USER', $_SESSION['user']);
