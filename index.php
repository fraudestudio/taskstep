<?php

include("includes/header.php");

use TaskStep\Logic\Data\LegacyMySql\{ItemDao, SettingsDao};

$items = new ItemDao();
$dailyItems = $items->readDaily(new DateTime('now'));

$settings = new SettingsDao();

$hour = date("H");
if ($hour <= 11) $intro = l->index->introMorning;
else if ($hour <= 18) $intro = l->index->introAfternoon;
else $intro = l->index->introEvening;
$intro .= l->index->introText;

?>

<div id="welcomebox">
	<h2>
		<img src="images/page.png" alt="" />&nbsp;<?= l->index->welcome ?>
	</h2>
	<p><?= $intro ?></p>
	<p>
		<img src="images/chart_bar.png" alt="" />&nbsp;
		<?php
			$undone = $items->countUndone();
			if($undone == 1) echo l->index->oneTask;
			else echo sprintf(l->index->nTasks, $undone);
		?>
	</p>
</div>

<div id="immediateblock">
	<h2>
		<img src="images/lightning.png" alt="" />
		<?= l->sections->immediate ?> (<?= count($dailyItems) ?>)
	</h2>

	<?php foreach($dailyItems as $item): ?>
	<div class='immediateitem'>
		<a href='display.php?display=section&section=immediate&cmd=do&id=<?= $item->id() ?>' title='<?= l->items->do ?>'>
			<img src='images/undone.png' alt='<?= l->items->do ?>' class='valign'/>
		</a>
		<a href='edit.php?id=<?= $item->id() ?>' title='<?= l->items->edit ?>'>
			<?= $item->title() ?>
		</a>
		<?= $item->date()->format(l->dateFormat->task) ?> | <?= $item->context()->title() ?>
	</div>
	<?php endforeach; ?>

	<?= empty($dailyItems) ? l->index->noImmediate : '' ?>
</div>

<?php if ($settings->displayTips()): ?>
<div id="tipsbox">
	<img src="images/information.png" alt="" />&nbsp;<?= l->index->tip ?>:
	<?= l->tips[rand(0, count(l->tips) - 1)] ?>
</div>
<?php endif;

include('includes/footer.php');

?>