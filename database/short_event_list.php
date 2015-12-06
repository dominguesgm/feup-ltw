<?php
  include_once("events.php");
  $body = file_get_contents('php://input');
  if(isset($body)){
    $json = json_decode($body, true);
    if(isset($json['attendance'])){
      $result = array();
      $result['attendance'] = getLimitedUserAttendance($json['attendance'], -1, 3);
      echo json_encode($result);
      return;
    } else {
      if(isset($json['creations'])){
        $result = array();
        $result['creations'] = getLimitedUserCreations($json['creations'], -1, 3);
        echo json_encode($result);
        return;
      } else echo 2;
    }
  } else echo 1;
  echo json_encode(array("error" => "while generating events"));
?>
