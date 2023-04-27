<?php

require_once "includes/autoload.php";

use TaskStep\Locale\Locale;
use TaskStep\Logic\Data\MySql\Dao\UserDao;
use TaskStep\Logic\Exceptions\NotFoundException;

Locale::load();

session_start();
header("Cache-control: private");

$failed = false;

if (isset($_POST["submit"]))
{
	$email = $_POST["email"];
	$password = $_POST["password"];

	try
	{
		$user = (new UserDao)->readByEmailAndPassword($email, $password);
		$_SESSION["loggedin"] = true;
		$_SESSION["user"] = $user;
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/');
		session_write_close();
		header("Location: http://$host$uri/index.php");
		exit;
	}
	catch (NotFoundException)
	{
		$_SESSION["loggedin"] = false;
		$failed = true;		
	}
}
else if (isset($_GET["action"]) && $_GET["action"] == "logout")
{
	$_SESSION['loggedin'] = false;
}

$loggedIn = $_SESSION['loggedin'] ?? false;

$style = $loggedIn ? $_SESSION['user']?->settings()->style()->value : 'classic'; 

?>
<!DOCTYPE html>
<html lang="<?= l->language() ?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>TaskStep - Login</title>
	<link rel='stylesheet' type='text/css' href='styles/<?= $style ?>.css' media='screen' />
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
			<input type="email" name="email" <?= $loggedIn ? 'disabled' : '' ?> required placeholder="example@mail.com"/>
			<br/><br/>
			<input type="password" name="password" autocomplete="current-password" <?= $loggedIn ? 'disabled' : '' ?> required/>
			<br/><br/>
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