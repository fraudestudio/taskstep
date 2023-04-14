<?php
function connect(){
	global $mysqli, $server, $user, $password, $db;

	if (!($mysqli and $mysqli->ping())) {
		$mysqli = new mysqli($server, $user, $password, $db); 
	}
	return $mysqli;
}

function stylesheet(){
	global $mysqli;
	$result = $mysqli->query("SELECT * FROM settings WHERE setting='style'");
	while($r = $result->fetch_array())
	{
		echo "<link rel='stylesheet' type='text/css' href='styles/".$r['value']."' media='screen' />";	//Use the stylesheet selected in the database
	}
}

function selfref_url(){
	$dirstuff = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
	$full = "http://".$_SERVER['HTTP_HOST'].$dirstuff;
	echo $full;
}

?>