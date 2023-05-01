<?php

require_once "includes/autoload.php";

use TaskStep\Logic\Data\MySql\Dao\ItemDao;
use TaskStep\Logic\Model\Export;
use TaskStep\Config;

$user = Export::verifyToken($_GET['user'] ?? '');
if (is_null($user)) exit;

header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="taskstep-export.csv"');

$allItems = (new ItemDao)->readAll($user);

$output = fopen("php://output", "wb");

foreach ($allItems as $item)
{
  	$row = [
		$item->id(),
		$item->title(),
		$item->date()?->format('Y-m-d') ?? '',
		$item->notes(),
		$item->url(),
		$item->section()->value,
		$item->context()->title(),
		$item->project()->title(),
		$item->done() ? 1 : 0,
	];

    fputcsv($output, $row);
}

fclose($output);