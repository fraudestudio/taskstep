<?php

$head = <<<'HEAD'
	<link rel="stylesheet" type='text/css' href="styles/system/jacs.css">
	<script type="text/javascript" src="script/jacsLang.js"></script>
	<script type="text/javascript" src="script/jacs.js"></script>
HEAD;

include("includes/header.php"); ?>

<script type="text/javascript"> <?php include('script/edit.js.php'); ?> </script>

<?php

use TaskStep\Logic\Model\{Item, User, Section, Context, Project};
use TaskStep\Logic\Data\MySql\Dao\{ItemDao, ContextDao, ProjectDao};

$itemDao = new ItemDao();
$item = new Item();
$itemId;

$contextDao = new ContextDao();
$contexts = $contextDao->readAll(USER);

$projectDao = new ProjectDao();
$projects = $projectDao->readAll(USER);

$showSuccessMessage = false;

// If 'id' is set in the request URL, then the user is editing a task and we need
// to grab its data from the database
if (isset($_GET['id']))
{
	$itemId = $_GET['id'];
	$item = $itemDao->readById(USER, $itemId);
}
// Otherwise, if the user has submitted a form, grab the rest of the form data
else if (isset($_POST["submit"]))
{
	if ($_POST['id'] !== '')
	{
		$itemId = intval($_POST['id']);
	}

	$item
		->setTitle($_POST['title'])
		->setDate($_POST['date'] == '' ? null : new DateTime($_POST['date']))
		->setNotes($_POST['notes'] ?? '')
		->setUrl($_POST['url'] ?? '')
		->setSection(Section::from($_POST['section']))
		->setContext($contextDao->readById(USER, intval($_POST['context'])))
		->setProject($projectDao->readById(USER, intval($_POST['project'])))
		->setDone(false);

	if (isset($itemId))
	{
		$itemDao->update(USER, $itemId, $item);
	}
	else
	{
		$itemDao->create(USER, $item);
		$item = new Item();
	}
	$showSuccessMessage = true;
}
else
{
	$item->setTitle(l->items->defaultTitle);
	if (isset($_GET['section'])) $item->setSection(Section::from($_GET['section']));
	if (isset($_GET['context'])) $item->setContext($contextDao->readById(USER, $_GET['context']));
	if (isset($_GET['project'])) $item->setProject($projectDao->readById(USER, $_GET['project']));
	if (isset($_GET['url'])) $item->setUrl($_GET['url']);
}

if ($showSuccessMessage): ?>
	<div id='updated' class='fade'>
	<?php if (isset($itemId)): ?>
		<img src='images/pencil_go.png' alt=''/> <?= l->message->item->updated ?>
	<?php else: ?>
		<img src='images/note_go.png' alt='' />  <?= l->message->item->added ?>
	<?php endif; ?>
	</div>
<?php endif; ?>

<form method="post" action="edit.php" id="addform">
<div>
<table>
<tr>
   <td><?php echo $l_forms_title; ?>:</td>
   <td colspan="3" rowspan="1"><input type='text' id="addtitle" name='title' value="<?php echo $title ?>" size="60" /></td>
</tr>
<tr>
   <td><?php echo $l_forms_notes; ?>:</td>
   <td colspan="3" rowspan="1"><input type='text' name='notes' value="<?php echo $notes ?>" size="60" /></td>
</tr>
<tr>
   <td></td>
   <td><?php echo $l_forms_section; ?>:</td>
   <td><?php echo $l_forms_context; ?>:</td>
   <td><?php echo $l_forms_project; ?>:</td>
</tr>
<tr>
	<td></td>
	<td>
		<select name='section' size="7">
		<?php
		$result4 = $mysqli->query("SELECT * FROM sections ORDER BY id");
		foreach($l_sectionlist as $key=>$value)
		{
			$selected = ($section == $key) ? 'selected="selected"' : '';
			echo "<option value='$key' $selected>$value</option>\n";
		}
		?>
		</select>
	</td>
	<td>
		<select name='context' size="7">
		<?php
		$result2 = $mysqli->query("SELECT * FROM contexts ORDER BY title");
		while($r=$result2->fetch_array())
		{
			$context2=$r["title"];
			$selected = ($context == $context2) ? 'selected="selected"' : '';
			echo "<option value='$context2' $selected>$context2</option>\n";
		} 
		?>
		</select>
	</td>
	<td>
		<select name='project' size="7">
		<?php
		$result3 = $mysqli->query("SELECT * FROM projects ORDER BY title");
		while($r=$result3->fetch_array())
		{
			$project2=$r["title"];
			$selected = ($project == $project2) ? 'selected="selected"' : '';
			echo "<option value='$project2' $selected>$project2</option>\n";
		}
		?>
		</select>
	</td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><span class="listlinkstyle"><a href="edit_types.php?type=context"><img src="images/context_edit.png" alt="" /> <?php echo $l_forms_contexte; ?></a></span></td>
	<td><span class="listlinkstyle"><a href="edit_types.php?type=project"><img src="images/project_edit.png" alt="" /> <?php echo $l_forms_projecte; ?></a></span></td>
</tr>
<tr>
   <td><?php echo $l_forms_date; ?>:</td>
   <td colspan="3" rowspan="1" id="holder">
      <input type='text' autocomplete="off" name='date' value="<?php echo $date ?>" size="60" class="datebox" onfocus="JACS.show(this,event);" />
   </td>
</tr>
<tr>
   <td><?php echo $l_forms_url; ?>:</td>
   <td>
      <input type='text' name='url' value="<?php echo $url ?>" size="60" />
   </td>
</tr>
<tr>
   <td></td>
   <td><?= l->forms->section ?>:</td>
   <td><?= l->forms->context ?>:</td>
   <td><?= l->forms->project ?>:</td>
</tr>
<tr>
	<td></td>
	<td>
		<select name='section' size="7" required="true">
		<?php foreach (Section::cases() as $section): ?>
			<option value='<?= $section->value ?>' <?= $item->section() == $section ? "selected='selected'" : '' ?> >
				<?= l->sections->{$section->value} ?>
			</option>
		<?php endforeach; ?>
		</select>
	</td>
	<td>
		<select name='context' size="7" required="true">
		<?php foreach ($contexts as $context): ?>
			<option value='<?= $context->id() ?>' <?= $item->context()->id() == $context->id() ? "selected='selected'" : '' ?> >
				<?= $context->title() ?>
			</option>
		<?php endforeach; ?>
		</select>
	</td>
	<td>
		<select name='project' size="7" required="true">
		<?php foreach ($projects as $project): ?>
			<option value='<?= $project->id() ?>' <?= $item->project()->id() == $project->id() ? "selected='selected'" : '' ?> >
				<?= $project->title() ?>
			</option>
		<?php endforeach; ?>
		</select>
	</td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td>
		<span class="listlinkstyle">
			<a href="edit_types.php?type=context">
				<img src="images/context_edit.png" alt="" />
				<?= l->forms->editContexts ?>
			</a>
		</span>
	</td>
	<td>
		<span class="listlinkstyle">
			<a href="edit_types.php?type=project">
				<img src="images/project_edit.png" alt="" />
				<?= l->forms->editProjects ?>
			</a>
		</span>
	</td>
</tr>
<tr>
   <td><?= l->forms->date ?>:</td>
   <td colspan="3" rowspan="1" id="holder">
      <input
      	type='text'
      	autocomplete="off"
      	name='date'
      	value="<?= $item->date()?->format('Y-m-d') ?? '' ?>"
      	size="60"
      	class="datebox"
      	onfocus="JACS.show(this,event);" />
   </td>
</tr>
<tr>
   <td><?= l->forms->url ?>:</td>
   <td colspan="3" rowspan="1">
      <input type='text' name='url' value="<?= $item->url() ?>" size="60" />
   </td>
</tr>
<tr>
   <td></td>
   <td colspan="3" rowspan="1">
   	<input type="submit" name="submit" value="<?= isset($itemId) ? l->forms->editButton : l->forms->addButton ?>" />
   </td> 
</tr>
</table> 
<input type="hidden" name="id" value="<?php echo $id ?>" />
</div>
</form>

<?php include('includes/footer.php'); ?>