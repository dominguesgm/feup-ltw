<?php
	if(file_exists('database.db'))
		$db = new PDO('sqlite:database.db');
	else $db = new PDO('sqlite:database/database.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
