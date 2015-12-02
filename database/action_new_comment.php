<?php
	session_start();
	include_once("comments.php");

  if((isset($_SESSION['username']))) {

  	$body = file_get_contents('php://input');

  	if(isset($body)){
  	  $json = json_decode($body, true);

	   if(isset($json['eventId']) && isset($json['time']) && isset($json['commentContent'])){

  	  	$success = addCommentToEvent($_SESSION['username'], $json['eventId'], $json['time'], $json['commentContent']);

		        if($success)
		        	echo json_encode(array('success' => 'success'));
		        else echo json_encode(array('error' => "Problem saving comment"));

		    }else echo json_encode(array('error' => "Request fields came empty"));

		}else echo json_encode(array('error' => "Request is empty"));

	}else echo json_encode(array('error' => "login required"));

?>
