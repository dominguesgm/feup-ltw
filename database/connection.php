<?php 
include_once('database/users.php');

// open database
function openDB(){
	return new PDO('sqlite:databasea.db');
}

?>
