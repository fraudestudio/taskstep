<?php

include("includes/header.php");

use TaskStep\Logic\Model\{Context, Project};
use TaskStep\Logic\Data\LegacyMySql\{ContextDao, ProjectDao};

$type = $_GET['type'] ?? '';
$getCommand = $_GET['cmd'] ?? '';
$postCommand = $_POST['cmd'] ?? '';

if ($type == 'context')
{
	$dao = new ContextDao();
	$model = Context::class;
}
else if ($type == 'project')
{
	$dao = new ProjectDao();
	$model = Project::class;
}
else
{
	// pas ouf mais ça fait le travail
	header('Location: index.php', true, 303);
	exit("unknown type '$type'");
}

$messageBoxIcon;
$messageBoxText;
$messageBoxId;
$panel = 'list';

// modification
if ($postCommand == "edit" && isset($_POST["submit"]))
{
	$id = $_POST['id'];
	$newTitle = $_POST["title"];

	$category = (new $model)->setTitle($newTitle);
	$dao->update($id, $category);

	$messageBoxIcon = 'pencil_go.png';
	$messageBoxText = l->message->$type->updated;
	$messageBoxId = 'updated';
}

// ajout
else if ($postCommand == 'add' && isset($_POST['add']))
{
	$newTitle = $_POST["newtitle"];

	$category = (new $model)->setTitle($newTitle);
	$dao->create($category);

	$messageBoxIcon = 'add.png';
	$messageBoxText = l->message->$type->added;
	$messageBoxId = 'updated';
}

// suppression
else if ($getCommand == "delete")
{
    $id = $_GET['id'];

	$dao->delete($id);

	$messageBoxIcon = 'bin.png';
	$messageBoxText = l->message->$type->deleted;
	$messageBoxId = 'deleted';
}

// formulaire de modification
else if ($getCommand == 'edit')
{
	if(!isset($_GET['id']))
	{
		$panel = 'noid';
	}
	else
	{
		$category = $dao->readById(intval($_GET['id']));
		$panel = 'edit';
	}
}

// formulaire d'ajout
else if ($getCommand == 'add')
{
	$panel = 'add';
}

if ($panel == 'list')
{
	$categories = $dao->readAll();
	usort($categories, function($a, $b) { return strnatcmp($a->title(), $b->title()); });
}

?>

<?php if (isset($messageBoxText)): ?>
<div id='<?= $messageBoxId ?>' class='fade'>
	<img src='images/<?= $messageBoxIcon ?>' alt=''/>
	<?= $messageBoxText ?>
</div>
<?php endif; ?>


<?php if ($panel == 'list'): ?>

<p><?= l->$type->chooseToEdit ?></p>
<div id='editlist'>
	<a href='edit_types.php?type=<?= $type ?>&cmd=add' class='listlinkssmart'>
		<img src='images/add.png' alt=''/> <?= l->$type->add ?>
	</a>
	<?php foreach ($categories as $category): ?>
	<a href='edit_types.php?type=<?= $type ?>&cmd=edit&id=<?= $category->id() ?>' class='listlinkssmart'>
		<img src='images/pencil.png' alt=''/> <?= $category->title() ?>
	</a>
	<?php endforeach; ?>
</div>


<?php elseif ($panel == 'noid'): ?>

<div class='error' style='font-size:9pt; padding:5px;'>
	<img src='images/exclamation.png' alt='' style='vertical-align:-3px;'/> <?= l->message->noId ?>
</div>
<span class='linkback'>
	<a href='edit_types.php?type=<?= $type ?>' class='linkback'>Return to editing <?= $type ?>s</a>
</span>


<?php elseif ($panel == 'edit'): ?>

<form action="edit_types.php?type=<?= $type ?>" method="post">
	<input type="hidden" name='id' value="<?= $category->id() ?>"/>
	<?= $l_forms_title ?>&nbsp;
	<input type="text" name="title" value="<?= $category->title() ?>" size="30"/><br/><br/>
	<input type="hidden" name="cmd" value="edit">
	<input type="submit" name="submit" value="<?= l->$type->edit ?>"/>
</form>
<br/>
<a href='edit_types.php?type=<?= $type ?>&cmd=delete&id=<?= $category->id() ?>'>
	<img src='images/bin_empty.png' alt=''/>
	<?= l->$type->delete ?>
</a>

<?php elseif ($panel == 'add'): ?>

<form action="edit_types.php?type=<?= $type ?>" method="post">
	<?= l->forms->title ?>&nbsp;
	<input type="text" name="newtitle" value="<?= l->$type->defaultTitle ?>" size="30"/><br/><br/>
	<input type="hidden" name="cmd" value='add'/>
	<input type="submit" name='add' value="<?= l->$type->add ?>"/>
</form>

<?php endif; 

include('includes/footer.php');

?>
