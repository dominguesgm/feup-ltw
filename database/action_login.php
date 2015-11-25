<?php session_start();
  include_once('users.php');
  $body = file_get_contents('php://input');
  if(isset($body)){
    $json = json_decode($body, true);
    if((isset($json['username'])) && (isset($json['password']))){
      if(getUser($json['username'], $json['password'])){
        $_SESSION['username'] = $json['username'];
        echo json_encode(array('success' => 'User signed in correctly'));
      } else echo json_encode(array('error' => "Username and password don't match"));
    } else echo json_encode(array('error' => "Request fields came empty"));
  } else echo json_encode(array('error' => "Request is empty"));

?>
