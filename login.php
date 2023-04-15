<?php

require_once "includes/autoload.php";

use TaskStep\Locale\Locale;
use TaskStep\Logic\Data\LegacyMySql\SettingsDao;

Locale::load();

session_start();
header("Cache-control: private");

$failed = false;

if (isset($_POST["submit"]))
{
	$password = $_POST["password"];
	if ((new SettingsDao)->checkPassword($password))
	{
		$_SESSION["loggedin"] = true;
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/');
		session_write_close();
		header("Location: http://$host$uri/index.php");
		exit;
	}
	else
	{
		$_SESSION["loggedin"] = false;
		$failed = true;
	}
}
else if (isset($_GET["action"]) && $_GET["action"] == "logout")
{
	$_SESSION['loggedin'] = false;
}

$loggedIn = $_SESSION['loggedin'];

?>
<!DOCTYPE html>
<html lang="<?= l->language() ?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>TaskStep - Login</title>
	<link rel='stylesheet' type='text/css' href='styles/<?= (new SettingsDao)->style() ?>.css' media='screen' />
</head>
<body>
	<!-- Begin container-->
	<div id="container">
	<!-- Begin content -->
	<div id="loginbox">
		<h1><img src="images/icon.png" alt="" />TaskStep</h1>
		
		<p>
			<img src="images/shield.png" alt="" />&nbsp;<?= l->login->prompt ?>
		</p>

		<form action="login.php" method="post"><p>
			<input type="password" name="password" autocomplete="current-password" <?= $loggedIn ? 'disabled' : '' ?> />
			<input type="submit" name="submit" value="<?= l->login->button ?>" <?= $loggedIn ? 'disabled' : '' ?> />
		</p></form>

		<p>
			<?php if ($loggedIn): ?>
			<?= l->login->alreadyLoggedIn ?>
			<?php elseif($failed): ?>
			<img src='images/cross.png' alt='' />&nbsp;<?= l->login->incorrect ?>
			<?php endif; ?>
		</p>

		<span class="securityinfo">TaskStep login system version 1.2</span>

<?php include('includes/footer.php') ?>