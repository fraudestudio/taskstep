<?php

require_once "includes/autoload.php";

use TaskStep\Logic\Data\LegacyMySql\ItemDao;

header('Content-type: text/xml');

$allItems = (new ItemDao)->readAll();

$baseUrl = $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/');

?><?xml version="1.0"?>
<rss version="2.0">
	<channel>
		<title>TaskStep</title>
		<link>http://<?= $baseUrl ?></link>
		<description>TaskStep Items Feed</description>
		<language>en-us</language>
		<generator>IceMelon RSS Feeder</generator>

		<?php foreach ($allItems as $item): ?>
		<item>
			<title> <?= $item->title() ?> </title>
			<link>http://<?= $baseUrl ?>/edit.php?id=<?= $item->id() ?></link>
			<description>
				<?= $item->date()?->format('Y-m-d | ') ?? '' ?>
				<?= $item->project()->title() ?> | 
				<?= $item->context()->title() ?>
				<?= $item->notes() !== '' ? ' | '.$item->notes() : '' ?>
			</description>
			<guid isPermaLink="false"><?= $item->id() ?>-<?= md5($item->title()) ?></guid>
		</item>
		<?php endforeach; ?>
	</channel>
</rss>
