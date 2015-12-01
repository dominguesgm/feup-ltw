<?php
session_start();
include_once('users.php');
$body = file_get_contents('php://input');
if(isset($body)){
  $json = json_decode($body, true);

  if(isset($json['username']) && isset($json['password']) && isset($json['name']) && isset($json['city']) && isset($json['email']) && isset($json['phoneNumber'])){
    $result = editUser($json['username'], $json['name'], $json['city'], $json['email'], $json['phoneNumber'], $json['password']);
    if($result)
      echo json_encode(array('success' => $json));
    else
      echo json_encode(array('error' => "Error updating user information"));
  } else echo json_encode(array('error' => $json));
} else echo json_encode(array('error' => "Request is empty"));
?>
