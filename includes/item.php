<?php

// La vue d'un item

if ($item->done()) $divClass = 'np';
else if ($item->dueToday()) $divClass = 'current';
else if ($item->overdue()) $divClass = 'old';
else $divClass = 'np';

if (!is_null($item->date())) $displayedDate = $item->date()->format(l->dateFormat->task);
else $displayedDate = '';

if ($item->done())
{
	$action = 'undo';
	$actionIcon = 'accept.png';
}
else
{
	$action = 'do';
	$actionIcon = 'undone.png';
}

?>

<div class='<?= $divClass ?>'>

	<span <?= $item->done() ? 'style="text-decoration:line-through;"' : '' ?> >
		<?= htmlspecialchars($item->title()) ?>
		<?= $displayedDate ?>
		|
		<?= htmlspecialchars($item->project()->title()) ?>
		|
		<?= htmlspecialchars($item->context()->title()) ?>
	</span>

	<a href='display.php?sort=<?= $sortBy . $baseActionUrl ?>&cmd=delete&id=<?= $item->id() ?>'
		title='<?= l->items->delete ?>'
		class='actionicon'>
		<img src='images/bin_empty.png' alt='<?= l->items->delete ?>' />
	</a>
	<a href='edit.php?id=<?= $item->id() ?>' title='<?= l->items->edit ?>' class='actionicon'>
		<img src='images/pencil.png' alt='<?= l->items->edit ?>' />
	</a> 
	<a href='display.php?sort=<?= $sortBy . $baseActionUrl ?>&cmd=<?= $action ?>&id=<?= $item->id() ?>'
		title='<?= l->items->$action ?>' class='actionicon'>
		<img src='images/<?= $actionIcon ?>' alt='<?= l->items->$action ?>' />
	</a>

	<br/>

	<?= htmlspecialchars($item->notes()) ?>

	<br/>

	<a href='<?= addslashes($item->url()) ?>' class='short-url'> <?= htmlspecialchars($item->url()) ?> </a>
	
</div> 