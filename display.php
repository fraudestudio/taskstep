<?php

include("includes/header.php");

use TaskStep\Logic\Data\LegacyMySql\{ItemDao, ContextDao, ProjectDao};
use TaskStep\Logic\Model\Section;

$items = new ItemDao();
$result = [];

if (isset($_GET["cmd"]))
{
	$id = $_GET["id"];

	switch ($_GET["cmd"])
	{
	case "delete":
		$items->delete($id);
		break;
	case "do":
	  	$item = $items->readById($id);
	  	$item->setDone(true);
	  	$items->update($id, $item);
	  	break;
	case "undo":
	  	$item = $items->readById($id);
	  	$item->setDone(false);
	  	$items->update($id, $item);
	  	break;
	default:
		$errorMessage = l->message->actionError;
		break;
	}
}

$display = $_GET["display"] ?? 'all';
$sortBy = $_GET["sort"] ?? 'date';
$section = isset($_GET["section"]) ? Section::from($_GET["section"]) : null;
$typeId = intval($_GET["tid"] ?? '');

$noResultsUrl = '';
$baseActionUrl = '';
$printUrl = '';
$formData = ['display' => $display];

switch ($display)
{
case "section":
	$result = $items->readBySection(USER, $section);

	$title = l->sections->{$section->value};
	$noResultsUrl = "?section=$section->value";
	$printUrl = "?print=section&section=$section->value";
	$formData['section'] = $section->value;
	break;

case "project":
	$project = (new ProjectDao)->readById($typeId);
	$result = $items->readByProject($project);

	$title = $project->title();
	$noResultsUrl = "?project=$typeId";
	$printUrl = "?print=project&id=$typeId";
	$formData['tid'] = $typeId;
	break;

case "context":
	$context = (new ContextDao)->readById($typeId);
	$result = $items->readByContext($context);

	$title = $context->title();
	$noResultsUrl = "?context=$typeId";
	$printUrl = "?print=context&id=$typeId";
	$formData['tid'] = $typeId;
	break;

case "all":
	$result = $items->readAll();

	$title = l->navigation->allItems;
	$printUrl = '?print=all';
	break;

case "today":
	$today = new Datetime('now');
	$result = $items->readByDate($today);

	$title = sprintf(l->navigation->today, $today->format(l->dateFormat->menu));
	$printUrl = "?print=today";	
	break;
}

switch ($sortBy)
{
case 'title':
	usort($result, function($a, $b) { return strnatcasecmp($a->title(), $b->title()); });
	break;
case 'date':
	usort(
		$result,
		function($a, $b) {
			if (is_null($a->date()))
			{
				if (is_null($b->date())) return 0;
				else return -1;
			}
			else
			{
				if (is_null($b->date())) return 1;
				else return $a->date()->getTimestamp() - $b->date()->getTimestamp();
			}
		}
	);
	break;
case 'context':
	usort($result, function($a, $b) { return strnatcasecmp($a->context()->title(), $b->context()->title()); });
	break;
case 'project':
	usort($result, function($a, $b) { return strnatcasecmp($a->project()->title(), $b->project()->title()); });
	break;
case 'done':
	usort($result, function($a, $b) { return $a->done() - $b->done(); });
	break;
}

foreach ($formData as $name => $value) $baseActionUrl .= "&$name=$value";

?>

<?php if (isset($errorMessage)): ?>
<div class='error'>
	<img src='images/exclamation.png' alt='' /> <?= $errorMessage ?>
</div>
<?php endif; ?>

<div class="sectiontitle">
	<h1> <?= $title ?> </h1>
</div>

<div class="sortform">
	<span class='printer'>
		<a href="print.php<?= $printUrl ?>">
			<img src='images/printer.png' alt='' />
			<?= l->items->print ?>
		</a>
	</span>

	<form action="display.php" method="get"><div>
		<?php foreach ($formData as $name => $value): ?>
		<input type="hidden" name="<?= $name ?>" value="<?= $value ?>" />
		<?php endforeach; ?>

		<?= l->items->sortText ?>

		<select name="sort">
			<?php foreach (['title', 'date', 'context', 'project', 'done'] as $sort): if ($sort != $display): ?>
			<option value="<?= $sort ?>" <?= $sort == $sortBy ? 'selected' : '' ?>>
				<?= l->items->sort->$sort ?>
			</option>';
			<?php endif; endforeach; ?>
		</select>
	
		<input type="submit" value="<?= l->items->sortButton ?>" />
	</div></form>
</div>

<?php if (count($result) == 0): ?>

<div class='inform'>
	<img src='images/information.png' alt='' />
	<?= $display == 'today' ? l->message->noneToday : l->message->noItems ?>
	
	<a href='edit.php<?= $noResultsUrl ?>'> <?= l->message->addSome ?></a>
</div>

<?php else: 

foreach ($result as $item)
{
	include 'includes/item.php';
}

endif;

include 'includes/footer.php';

?>