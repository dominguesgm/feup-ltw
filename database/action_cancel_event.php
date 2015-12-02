<?php
	session_start();
	include_once("events.php");

  if((isset($_SESSION['username']))) {

  	$body = file_get_contents('php://input');

  	if(isset($body)){
  	  $json = json_decode($body, true);

	   if(isset($json['eventId'])) {
    
  	  	$success = deleteEvent($json['eventId'], $_SESSION['username']);

		        if($success)
		        	echo json_encode(array('success' => 'success'));
		        else echo json_encode(array('error' => "Problem attending event"));

		    }else echo json_encode(array('error' => "Request fields came empty"));

		}else echo json_encode(array('error' => "Request is empty"));

	}else echo json_encode(array('error' => "login required"));

?>