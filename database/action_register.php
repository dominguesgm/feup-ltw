<?php session_start();
  include_once('users.php');
  $body = file_get_contents('php://input');
  if(isset($body)){
    $json = json_decode($body, true);
    if(isset($json['username']) && isset($json['password']) && isset($json['fullName']) && isset($json['city']) && isset($json['email']) && isset($json['phoneNumber'])){
      if(!userExists($json['username'])){
        if(createUser($json['username'], $json['password'], $json['fullName'], $json['city'], $json['email'], $json['phoneNumber'])){
          $_SESSION['username'] = $json['username'];
          echo json_encode(array('success' => 'User registered correctly'));
        } else echo json_encode(array('error' => "Problem registering user"));
      } else echo json_encode(array('error' => "User already exists"));
    } else echo json_encode(array('error' => "Request fields came empty"));
  } else echo json_encode(array('error' => "Request is empty"));
?>
