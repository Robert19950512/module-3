<?php

$mysqli = new mysqli('localhost', 'gw1', '123456', 'gw2');

if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>