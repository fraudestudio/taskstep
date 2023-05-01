<?php

require_once "includes/autoload.php";

use TaskStep\Logic\Data\MySql\Dao\{ItemDao, ProjectDao, ContextDao};
use TaskStep\Locale;
use TaskStep\Logic\Model\{Section, Export};

// === BEGIN AUTHENTIFICATION ===

session_start();  
header("Cache-control: private");

if($_SESSION['loggedin'])
{
	$user = $_SESSION['user'];
}
else
{
	$user = Export::verifyToken($_GET['user'] ?? '');

	if (is_null($user))
	{
		$host  = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/');
		$then = rawurlencode(ltrim($_SERVER['REQUEST_URI'], '/'));
		session_write_close();
		header("Location: http://$host$baseUri/login.php?then=$then");
		exit;
	}
}

// === END AUTHENTIFICATION ===

Locale::load();

$items = new ItemDao();

$print = $_GET['print'] ?? '';

switch ($print)
{
case "section":
	try
	{
		$section = Section::from($_GET['section'] ?? '');
		$result = $items->readBySection($user, $section);

		$title = l->sections->{$section->value};
	}
	catch (ValueError)
	{
		$error = l->print->sectionNotFound;
	}
	break;

case "project":
	$project = (new ProjectDao)->readById($user, intval($_GET['tid']));
	$result = $items->readByProject($project);

	$title = $project->title();
	break;

case "context":
	$context = (new ContextDao)->readById($user, intval($_GET['tid']));
	$result = $items->readByContext($context);

	$title = $context->title();
	break;

case "all":
	$result = $items->readAll($user);

	$title = l->print->allTasks;
	break;

case "today":
	$today = new Datetime('now');
	$result = $items->readByDate($user, $today);

	$title = sprintf(l->print->today, $today->format(l->dateFormat->menu));
	break;
}

?>
<!DOCTYPE html>
<html lang="<?= l->language() ?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>TaskStep - <?= l->print->commonTitle ?></title>
	<link rel="stylesheet" type="text/css" href="styles/system/print-style.css" />
</head>
<body>
	<!-- Begin container-->
	<div id="container">

	<h1> <?= $title ?> </h1>

	<ul>
		<?php foreach ($result as $item): ?>
		<li>
			<?= $item->title() ?> <br/>
			<?= $item->date()?->format(l->dateFormat->task . ' | ') ?? '' ?>
			<?= $item->context()->title() ?><br/>
			<?= $item->url() ?>
		</li>
		<?php endforeach; ?>
	</ul>

	<!-- End container-->
	</div>
</body>
</html>