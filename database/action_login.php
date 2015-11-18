<?php session_start();
  include_once('users.php');
  var_dump($_POST);
  if(isset($_POST['username']) && isset($_POST['password'])){
    if(userExists($_POST['username'], $_POST['password'])){
      $_SESSION['username'] = $_POST['username'];
      echo 'worked';
      //header('Location: index.php');
    } else{
      $_SESSION['issue'] = 'Username invalid or already in use';
      echo 'not worked';
      //header('Location: index.php');
    }
  }
?>
