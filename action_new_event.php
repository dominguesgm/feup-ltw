<?php
	session_start(); 

	if (!isset($_SESSION['username'])) {
 		header("Location: homepage.php");		/// TODO change page
    	die;
  	}

  	include_once("database/events.php");

	createEvent($_SESSION['username'], $_POST['nametag'], $_POST['type'], $_POST['description'], $_POST['time'], $_POST['city'], $_POST['address'], $_POST['imageURL'], $_POST['publicEvent']);

  	header("Location: event.php?id=" . $_POST['id']);
?>
