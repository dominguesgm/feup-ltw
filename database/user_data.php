<?php
  include_once("users.php");
  include_once("connection.php");
  $result = array();
  if(isset($_GET['user'])){
    $checkExistance = userExists($_GET['user']);
    if($checkExistance == true){
      $userData = getUser($_GET['user']);
      if($userData == false){
        $result = array("error" => "user data corrupted");
        return;
      } else {
        $dataArray = array("username" => $userData['username'],
                          "name" => $userData['name'],
                          "email" => $userData['email'],
                          "phoneNumber" => $userData['phoneNumber'],
                          "city" => $userData['city']);
        if(isset($_SESSION['username'])){
          if($_GET['user'] == $_SESSION['username']){
            $result = array("same" => $dataArray);
          } else {
            $result = array("different" => $dataArray);
          }
        } else {
          $result = array("different" => $dataArray);
        }
      }
    } else $result = array("error" => "no such user");
  } else $result = array("error" => "no such user");
 ?>
