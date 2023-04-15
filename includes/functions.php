<?php
function connect(){
	global $mysqli, $server, $user, $password, $db;

	if (!($mysqli and $mysqli->ping())) {
		$mysqli = new mysqli($server, $user, $password, $db); 
	}
	return $mysqli;
}

?>