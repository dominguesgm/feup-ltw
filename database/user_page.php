<?php
  session_start();
  include_once("users.php");
  include_once("connection.php");
  $body = file_get_contents('php://input');
  if(isset($body)){
    $json = json_decode($body, true);
    if(isset($json['username'])){
      $checkExistance = userExists($json['username']);
      if($checkExistance == true){
        $userData = getUser($json['username']);
        if($userData == false){
          echo json_encode(array("error" => "user data corrupted"));
          return;
        } else {
          $dataArray = array("username" => $userData['username'],
                            "name" => $userData['name'],
                            "email" => $userData['email'],
                            "phoneNumber" => $userData['phoneNumber'],
                            "city" => $userData['city']);
          if(isset($_SESSION['username'])){
            if($json['username'] == $_SESSION['username']){
              echo json_encode(array("same" => $dataArray));
              return;
            } else {
              echo json_encode(array("different" => $dataArray));
              return;
            }
          } else {
            echo json_encode(array("different" => $dataArray));
            return;
          }
        }
      }
    }
  }
  echo json_encode(array("error" => "no such user"));
 ?>
