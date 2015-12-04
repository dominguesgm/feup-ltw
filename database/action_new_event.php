<?php session_start();

  include_once("events.php");

  if((isset($_SESSION['username']))) {

  	$body = file_get_contents('php://input');

  	if(isset($body)){
  	  $json = json_decode($body, true);

	    if( (isset($json['nameTag'])) && (isset($json['type'])) && (isset($json['description']))
	    	&& (isset($json['time'])) && (isset($json['city'])) && (isset($json['address']))
	    	&& (isset($json['imageURL'])) && (isset($json['publicEvent']))) {

	     	$eventId = createEvent($_SESSION['username'], $json['nameTag'],
						     		$json['type'], $json['description'], $json['time'],
						     			$json['city'], $json['address'], $json['publicEvent'], $json['imageURL']);

		        if($eventId!=-1)
		        	echo json_encode(array('success' => $eventId));
		        else echo json_encode(array('error' => "Problem creating event"));

		    }else echo json_encode(array('error' => "Request fields came empty"));

		}else echo json_encode(array('error' => "Request is empty"));

	}else echo json_encode(array('error' => "login required"));
?>
