<?php

include("includes/header.php");

use TaskStep\Logic\Data\MySql\Dao\{ContextDao, ProjectDao};

$type = $_GET['type'] ?? '';

if ($type == 'context')
{
	$dao = new ContextDao();
}
else if ($type == 'project')
{
	$dao = new ProjectDao();
}
else
{
	// pas ouf mais ça fait le travail
	header('Location: index.php', true, 303);
	exit("unknown type '$type'");
}

$categories = $dao->readAll(USER);
usort($categories, function($a, $b) { return strnatcasecmp($a->title(), $b->title()); });

?>

<div id='editlist'>
	<p> <?= l->$type->chooseToList ?> </p>
	
	<a href='edit_types.php?type=<?= $type ?>&cmd=add' class='listlinkssmart'>
		<img src='images/add.png' alt='' />
		<?= l->$type->add ?>
	</a>

	<?php foreach ($categories as $category): ?>
	<a href='display.php?display=<?= $type ?>&tid=<?= $category->id() ?>&sort=date' class='listlinkssmart'>
		<img src='images/<?= $type ?>.png' alt='' />
		<?= $category->title() ?>
	</a>
	<?php endforeach; ?>

	<a href='edit_types.php?type=<?= $type ?>' class='listlinkssmart'>
		<img src='images/<?= $type ?>_edit.png' alt='' />
		<?= l->$type->edit ?>
	</a>
</div>

<?php include('includes/footer.php'); ?>