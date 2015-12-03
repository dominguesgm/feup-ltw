<?php
  include_once("events.php");
  include_once("users.php");
  $body = file_get_contents('php://input');
  if(isset($body)){
    $json = json_decode($body, true);
    $username = $json['username'];
    $eventId = $json['eventId'];
    $testuser = userExists($username);
    $testevent = eventExists($eventId);
    if($testuser && gettype($testuser) != "string" && $testevent && gettype($testevent) != "string"){
      if(isInvitedToEvent($username, $eventId)){
        if(inviteToEvent($username, $eventId, false)){
          echo json_encode(array("success" => "invite removed"));
          return;
        }
      } else {
        echo json_encode(array("error" => "user wasnt invited"));
        return;
      }
    } else {
      echo json_encode(array("error" => "user does not exist"));
      return;
    }
  }
  echo json_encode(array("error" => "invite could not be removed"));

?>
