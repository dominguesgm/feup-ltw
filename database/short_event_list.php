<?php
  include_once("events.php");
  $body = file_get_contents('php://input');
  if(isset($body)){
    $json = json_decode($body, true);
    if(isset($json['username'])){
      $result = array();

      $result['attendance'] = getLimitedUserAttendance($json['username'], 3);

      $result['creations'] = getLimitedUserCreations($json['username'], 3);

      echo json_encode($result);
      return;
    }
  }
  echo json_encode(array("error" => "while generating events"));
?>
