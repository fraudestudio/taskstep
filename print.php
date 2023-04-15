<?php

include("includes/sessioncheck.php");

require_once "includes/autoload.php";

use TaskStep\Logic\Data\LegacyMySql\{ItemDao, ProjectDao, ContextDao};
use TaskStep\Locale\Locale;

Locale::load();

$items = new ItemDao();

$print = $_GET['print'] ?? '';

switch ($print)
{
case "section":
	$result = $items->readBySection($_GET['section']);

	$title = l->sections->{$section->value};
	break;

case "project":
	$project = (new ProjectDao)->readById(intval($_GET['tid']));
	$result = $items->readByProject($project);

	$title = $project->title();
	break;

case "context":
	$context = (new ContextDao)->readById(intval($_GET['tid']));
	$result = $items->readByContext($context);

	$title = $context->title();
	break;

case "all":
	$result = $items->readAll();

	$title = l->navigation->allItems;
	break;

case "today":
	$today = new Datetime('now');
	$result = $items->readByDate($today);

	$title = sprintf(l->navigation->today, $today->format(l->dateFormat->menu));
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
	<!--Open container-->
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

	<!--Close container-->
	</div>
</body>
</html>