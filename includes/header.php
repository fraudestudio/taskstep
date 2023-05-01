<?php

include "sessioncheck.php";

require_once "autoload.php";

use TaskStep\Locale;
use TaskStep\Logic\Data\MySql\Dao\{ItemDao, UserDao};
use TaskStep\Logic\Model\Section;

Locale::load();

$style = USER->settings()->style()->value;

$sectionItemsCount = (new ItemDao)->countBySection(USER);

?>

<!DOCTYPE html>
<html lang="<?= l->language() ?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<title>TaskStep</title>

	<link rel='stylesheet' type='text/css' href='styles/<?= $style ?>.css' media='screen' />
	<link rel="stylesheet" type="text/css" href="styles/system/print.css" media="print" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="rss.php" />
	<script type="text/javascript" src="script/fat.js"></script>

	<?= $head ?? '' ?>
</head>

<body>
<!-- Begin container -->
<div id="container">

	<!-- Header -->
	<div id="header">
		<h1>
			<img src="images/icon.png" alt="" style="vertical-align:middle"/>&nbsp;<a href="index.php">
				TaskStep <span class="subtitle">1.2-dev</span>
			</a>
		</h1>
	</div>
	<div id="headernav">
		<ul>
			<li><a href="display.php?display=today&sort=done">
				<img src="images/calendar_view_day.png" alt="" />
				<?= sprintf(l->navigation->today, (new DateTime('now'))->format(l->dateFormat->menu)) ?></a>
			</li>
			<li><a href="index.php">
				<img src="images/house.png" alt="" />
				<?= l->navigation->home ?></a>
			</li>
			<li><a href="display.php?display=all&sort=date">
				<img src="images/page_white_text.png" alt="" />
				<?= l->navigation->allItems ?></a>
			</li>
			<li><a href="display_type.php?type=context">
				<img src="images/context.png" alt="" />
				<?= l->navigation->context ?></a>
			</li>
			<li><a href="display_type.php?type=project">
				<img src="images/project.png" alt="" />
				<?= l->navigation->project ?></a>
			</li>
			<li><a href="settings.php">
				<img src="images/textfield_rename.png" alt="" />
				<?= l->navigation->settings ?></a>
			</li>
			<li><a href="http://www.taskstep.com/taskstep">
				<img src="images/help.png" alt="" />
				<?= l->navigation->help ?></a>
			</li>
			<li><a href="login.php?action=logout">
				<img src="images/door_in.png" alt="" />
				<?= l->navigation->logout ?></a>
			</li>
		</ul>
	</div>

	<!-- Sidebar -->
	<div id="sidebar">                     
	    <ul>
			<li><a href="edit.php"><?= l->sidebar->add; ?></a></li>
			<?php foreach (Section::cases() as $section): ?>
			<li><a class="<?= $section->value ?>" href="display.php?display=section&section=<?= $section->value ?>&sort=date">
				<?= l->sections->{$section->value} ?>
				<span class="done">(<?= $sectionItemsCount[$section->value]['done'] ?>)</span>
				<span class="undone">(<?= $sectionItemsCount[$section->value]['undone'] ?>)</span>
			</a></li>
			<?php endforeach; ?>
	    </ul>
	</div>

	<!-- Begin content -->
	<div id="content">