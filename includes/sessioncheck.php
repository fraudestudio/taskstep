<?php

require_once "autoload.php";

session_start();  
header("Cache-control: private");

if(!$_SESSION['loggedin'])
{
	$host  = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/');
	$then = rawurlencode(ltrim($_SERVER['REQUEST_URI'], '/'));
	session_write_close();
	header("Location: http://$host$baseUri/login.php?then=$then");
	exit;
}

define('USER', $_SESSION['user']);
