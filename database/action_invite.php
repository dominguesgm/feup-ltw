<?php
  session_start();
  include_once("events.php");
  include_once("users.php");

  $body = file_get_contents('php://input');
  if(isset($body)){
    $json = json_decode($body, true);
    $username = $json['username'];
    $eventId = $json['eventId'];
    $testuser = userExists($username);
    $testevent = eventExists($eventId);
    if($testuser == true && gettype($testuser) != "string" && $testevent == true && gettype($testevent) != "string"){
      if(!isInvitedToEvent($username, $eventId) && $username != $_SESSION['username']){
        if(inviteToEvent($username, $eventId, true)){
          echo json_encode(array("success" => "user invited"));
          return;
        }
      } else {
        echo json_encode(array("error" => "user already invited"));
        return;
      }
    } else {
      echo json_encode(array("error" => "user does not exist"));
      return;
    }
  }
  echo json_encode(array("error" => "user could not be invited"));

?>
