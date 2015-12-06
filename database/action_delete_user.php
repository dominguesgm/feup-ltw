<?php
session_start();
include_once('users.php');

	if(isset($_SESSION['username'])) {
		if(deleteUser($_SESSION['username'])) {
 			unset($_SESSION['username']);
  			session_destroy();
			header('Location: ../');
		}else{
			header('Location: index.php');
		}
	}else header('Location: login.php');    
?>
