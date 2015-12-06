<?php
	session_start();
	include_once("events.php");
  $body = file_get_contents('php://input');
	if(isset($body)){
	  $json = json_decode($body, true);
    if(isset($json['username']) && isset($json['query']) && isset($json['limit']) && isset($json['offset'])) {
	    $success = getEventsSearch($json['query'], $json['username'], $json['limit'], $json['offset']);
      if($success != false)
      	echo json_encode(array('success' => $success));
      else echo json_encode(array('error' => "Problem getting result list"));
    }else echo json_encode(array('error' => "Request fields came empty"));
	} else echo json_encode(array('error' => "body undefined"));
?>
