<?php
function connect(){
	global $mysqli, $server, $user, $password, $db;

	if (!($mysqli and $mysqli->ping())) {
		$mysqli = new mysqli($server, $user, $password, $db); 
	}
	return $mysqli;
}

function pagespecific(){
	global $language, $l_cp_tools_purgecheck;
	$currentFile = $_SERVER["SCRIPT_NAME"];
    $parts = Explode('/', $currentFile);
    $currentFile = $parts[count($parts) - 1];
	switch ($currentFile)
	{
	case 'settings.php':
		
	break;
	}
}

function stylesheet(){
	global $mysqli;
	$result = $mysqli->query("SELECT * FROM settings WHERE setting='style'");
	while($r = $result->fetch_array())
	{
		echo "<link rel='stylesheet' type='text/css' href='styles/".$r['value']."' media='screen' />";	//Use the stylesheet selected in the database
	}
}

function display_items($display = '', $section = '', $tid = '', $sortby = ''){
	global $mysqli, $result, $l_items_do, $l_items_edit, $l_items_del, $l_items_undo, $task_date_format;

}

function selfref_url(){
	$dirstuff = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
	$full = "http://".$_SERVER['HTTP_HOST'].$dirstuff;
	echo $full;
}

function sort_form($type = '', $section = '', $tid = '', $sortby = ''){
	
	global $l_items_sorttext, $l_items_sort, $l_items_sortbutton, $l_items_print;
	
}
?>