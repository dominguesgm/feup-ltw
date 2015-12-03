<?php
	session_start();
	include_once("events.php");
  $body = file_get_contents('php://input');
	if(isset($body)){
	  $json = json_decode($body, true);
    if(isset($json['eventId'])) {
	    $success = eventAttendance($json['eventId']);
      if($success)
      	echo json_encode(array('success' => $success));
      else echo json_encode(array('error' => "Problem getting event attendance"));
    }else echo json_encode(array('error' => "Request fields came empty"));
	} else echo json_encode(array('error' => "body undefined"));
?>
