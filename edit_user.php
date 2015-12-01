<?php
  session_start();
  include_once("database/users.php");
  if(isset($_SESSION['username']) && isset($_POST['username'])){
    include('templates/header.php');
    if($_SESSION['username'] == $_POST['username']){
      $userData = getUser($_POST['username']);
      if($userData != false){?>
        <form class="editForm" id="userEdit">
          <input name="username" value=<?= '"' . $userData['username'] . '"' ?> hidden>
          <label>Name*</label>
          <input name="name" placeholder="Name" value=<?= '"' . $userData['name'] . '"' ?>>
          <label>Email*</label>
          <input name="email" placeholder="Email" value=<?= '"' . $userData['email'] . '"' ?>>
          <label>Phone Number</label>
          <input name="phoneNumber" placeholder="Phone Number" value=<?= '"' . $userData['phoneNumber'] . '"' ?>>
          <label>City*</label>
          <input name="city" placeholder="City" value=<?= '"' . $userData['city'] . '"' ?>>
          <label>Password (leave blank if you wish to maintain the current password)</label>
          <input name="password" type="password" placeholder="Password">
          <label>Repeat Password</label>
          <input name="passcheck" type="password" placeholder="Repeat Password">
          <input name="button" type="submit" value="Save Changes">
        </form>
        <script type="text/javascript" src="scripts/edit_user.js"></script><?php
        return;
      }
    }
  }
  header("Location: index.php");

 ?>
