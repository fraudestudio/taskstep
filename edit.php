<?php

include("includes/header.php");

use TaskStep\Logic\Model\{Item, User, Section, Context, Project};
use TaskStep\Logic\Data\LegacyMySql\{ItemDao, ContextDao, ProjectDao};

$itemDao = new ItemDao();
$item = new Item();
$itemId;

$contextDao = new ContextDao();
$contexts = $contextDao->readAll();

$projectDao = new ProjectDao();
$projects = $projectDao->readAll();

$showSuccessMessage = false;

// If 'id' is set in the request URL, then the user is editing a task and we need
// to grab its data from the database
if (isset($_GET['id']))
{
	$itemId = $_GET['id'];
	$item = $itemDao->readById($itemId);
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
		->setDate(isset($_POST['date']) ? new DateTime($_POST['date']) : null)
		->setNotes($_POST['notes'] ?? '')
		->setUrl($_POST['url'] ?? '')
		->setSection(Section::from($_POST['section']))
		->setContext(new Context(intval($_POST['context'])))
		->setProject(new Project(intval($_POST['project'])))
		->setDone(false);

	if (isset($itemId))
	{
		$itemDao->update($itemId, $item);
	}
	else
	{
		$itemDao->create($item);
		$item = new Item($user);
	}
	$showSuccessMessage = true;
}
else
{
	$item->setTitle($l_forms_titledefval); 
}

if ($showSuccessMessage): ?>
	<div id='updated' class='fade'>
	<?php if (isset($itemId)): ?>
		<img src='images/pencil_go.png' alt=''/> <?= $l_msg_itemedit ?>
	<?php else: ?>
		<img src='images/note_go.png' alt='' />  <?= $l_msg_itemadd ?>
	<?php endif; ?>
	</div>
<?php endif; ?>

<form method="post" action="edit.php" id="addform">
<div>
<table>
<tr>
   <td><?= $l_forms_title ?>:</td>
   <td colspan="3" rowspan="1">
   	<input type='text' id="addtitle" name='title' value="<?= $item->title() ?>" size="60" />
   </td>
</tr>
<tr>
   <td><?= $l_forms_notes ?>:</td>
   <td colspan="3" rowspan="1">
   	<input type='text' name='notes' value="<?= $item->notes() ?>" size="60" />
   </td>
</tr>
<tr>
   <td></td>
   <td><?= $l_forms_section ?>:</td>
   <td><?= $l_forms_context ?>:</td>
   <td><?= $l_forms_project ?>:</td>
</tr>
<tr>
	<td></td>
	<td>
		<select name='section' size="7" required="true">
		<?php foreach (Section::cases() as $section): ?>
			<option value='<?= $section->value ?>' <?= $item->section() == $section ? "selected='selected'" : '' ?> >
				<?= $l_sectionlist[$section->value] ?>
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
				<?= $l_forms_contexte ?>
			</a>
		</span>
	</td>
	<td>
		<span class="listlinkstyle">
			<a href="edit_types.php?type=project">
				<img src="images/project_edit.png" alt="" />
				<?= $l_forms_projecte ?>
			</a>
		</span>
	</td>
</tr>
<tr>
   <td><?= $l_forms_date ?>:</td>
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
   <td><?= $l_forms_url ?>:</td>
   <td colspan="3" rowspan="1">
      <input type='text' name='url' value="<?= $item->url() ?>" size="60" />
   </td>
</tr>
<tr>
   <td></td>
   <td colspan="3" rowspan="1">
   	<input type="submit" name="submit" value="<?= $l_forms_button[isset($itemId) ? 'edit' : 'add'] ?>" />
   </td> 
</tr>
</table>
<input type="hidden" name="id" value="<?= $itemId ?? '' ?>" />
</div>
</form>

<?php include('includes/footer.php'); ?>