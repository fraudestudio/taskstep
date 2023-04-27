<?php include("includes/header.php"); ?>

<script type="text/javascript"> <?php include('script/settings.js.php'); ?> </script>

<?php

use TaskStep\Logic\Data\MySql\Dao\{ItemDao, UserDao};
use TaskStep\Logic\Exceptions\NotFoundException;
use TaskStep\Logic\Model\Style;

$users = new UserDao();
$items = new ItemDao();
$styles = Style::cases();

$showTips = USER->settings()->tips();
$currentStyle = USER->settings()->style();

// Display settings
if (isset($_POST["submit"]))
{
	$settingsStatus = [];
	
	$tips = isset($_POST['tips']);
	$users->updateTips(USER, $tips);
	if ($tips) array_push($settingsStatus, l->settings->display->tipsOn);
	else array_push($settingsStatus, l->settings->display->tipsOff);

	$style = $_POST['style'];
	if (in_array($style, $styles))
	{
		$users->updateStyle(USER, $style);
		array_push($settingsStatus, sprintf(l->settings->display->usingStyle, $style));
	}
}

// Password modification
if (isset($_POST["passchanges"]))
{
	$newPassword = $_POST['newpass'];
	$newPasswordAgain = $_POST['newpassagain'];

	if (($newPassword !== $newPasswordAgain) && ($newPassword !== ''))
	{
		$passwordMessage = l->settings->password->noMatch;
	}
	else 
	{
		try 
		{
			$user = $users->readByEmailAndPassword(USER->email(), $_POST['currentpass']);
			$users->changePassword($user, $newPassword);
			$passwordMessage = l->settings->password->updated;
		}
		catch (NotFoundException)
		{
			$passwordMessage = l->settings->password->incorrect;
		}
	}
}

// Purge tool
if (isset($_GET['delete'])) 
{
	$purged = $items->deleteAllDone(USER);
}
else
{
	$purged = -1;
}

// CSV export tool
if(isset($_GET['export']))
{
	$exported = true;
	$exportFile = "taskstep-export.csv";

	if (is_file($exportFile)) unlink($exportFile);

	if (!$file_handle = fopen($exportFile, "a"))
	{
		echo "Cannot open file";
		$exported = false;
	}

	$allItems = $items->readAll(USER);

	foreach ($allItems as $item)
	{
		$row = implode(',', [
			$item->id(),
			$item->title(),
			$item->date()?->format('Y-m-d') ?? '',
			$item->notes(),
			$item->url(),
			$item->section()->value,
			$item->context()->title(),
			$item->project()->title(),
			$item->done() ? 1 : 0,
		]);

		if (!fwrite($file_handle, $row . '\n'))
		{
			echo "Cannot write to file";
			$exported = false;
			break;
		}
	}

	fclose($file_handle);
	chmod($exportFile, 0755);
}
else
{
	$exported = false;
}

$baseUrl = $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/');

?>

<div id="bookmarklet">
	<?= l->settings->bookmarklet->text ?>
	<br />
	<a href="javascript:window.open('http://<?= $baseUrl ?>/edit.php?url=' + document.location.href, 'taskstep', 'noreferrer');">
		<img src="images/bookmarklet.jpg" alt="<?= l->settings->bookmarklet->link ?>" />
	</a>
</div>

<div class="settingssection">
	<h2><b><?= l->settings->display->title ?></b></h2>
	
	<?php if (isset($settingsStatus)): ?>
	<div id='updated' style='width: 20em;'>
		<img src='images/accept.png' alt='' />&nbsp;<?= l->settings->display->settingsUpdated ?>
		<br/>
		<span class='italic'><?= implode('<br/>', $settingsStatus) ?></span>
	</div>
	<?php endif; ?>
	
	<form action='settings.php' method='post'>
		<div>
			<?= l->settings->display->tips ?>:
			<input type='checkbox' value='tips' name='tips' <?= $showTips ? 'checked' : '' ?> />
			<br/><br/>
			<?= l->settings->display->css ?><br />
			<select name="style">
				<?php foreach ($styles as $style): ?>
				<option value='<?= $style->value ?>' <?= $style == $currentStyle ? 'selected' : '' ?> ><?= $style->value ?></option>
				<?php endforeach; ?>
			</select><br />
			<br />
			<input name="submit" type="submit" value="<?= l->settings->display->button ?>" />
		</div>
	</form>
</div>

<div class="breaker"></div>

<div id="passwordsettings" class="settingssection">
	<h2><b><?= l->settings->password->title; ?></b></h2>
	<?= $passwordMessage ?? '' ?><br/>
	<form action='settings.php' method='post'>
		<div>
			<table>
				<tr>
					<td><?= l->settings->password->current ?><span class="marked">*</span>:</td>
					<td><input type="password" name="currentpass" class="necessary" required autocomplete="current-password"/></td>
				</tr>
				<tr>
					<td><?= l->settings->password->new; ?>:</td>
					<td><input type="password" name="newpass" required autocomplete="new-password"/></td>
				</tr>
				<tr>
					<td><?= l->settings->password->newAgain; ?>:</td>
					<td><input type="password" name="newpassagain" required autocomplete="new-password"/></td>
				</tr>
			</table>
			<br /><?= sprintf(l->settings->password->requiredFields, '<span class="marked">*</span>') ?>
			<br /><input name="passchanges" type="submit" value="<?= l->settings->password->button ?>" />
		</div>
	</form> 
</div>

<div class="breaker"></div>

<div class="settingssection">
	<h2><b><?= l->settings->tools->title ?></b></h2>
	<span class="purgebutton">
		<img src="images/bomb.png" alt=""/>
		<?php if ($purged == -1): ?>
			<a href='javascript:;' onclick='check()'> <?= l->settings->tools->purge ?> </a>
		<?php else: ?>
			<?= sprintf(l->settings->tools->purged, $purged) ?>
		<?php endif; ?>
	</span>
	&ensp;
	<span class="purgebutton">
		<img src="images/application_get.png" alt=""/>
		<a href="install/update-latest.php"> <?= l->settings->tools->update; ?> </a>
	</span>
	&ensp;
	<span class="purgebutton">
		<img src="images/page_white_excel.png" alt=""/>
		<?php if ($exported): ?>
			Exported to <a href='tasktep-export.csv'>taskstep-export.csv</a>
		<?php else: ?>
			<a href="settings.php?export=csv"> <?= l->settings->tools->export ?> </a>
		<?php endif; ?>
	</span>
</div>

<?php include('includes/footer.php'); ?>