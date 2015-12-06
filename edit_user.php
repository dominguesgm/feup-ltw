<div id="edit_user">
  <img src="res/set.png" width="40" height="40">
  <h4>Account</h4><br><br>
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
          <br><br>
          <label>Email*</label>
          <input name="email" placeholder="Email" value=<?= '"' . $userData['email'] . '"' ?>>
          <br><br>
          <label>Phone number</label>
          <input name="phoneNumber" placeholder="Phone number" value=<?= '"' . $userData['phoneNumber'] . '"' ?>>
          <br><br>
          <label>City*</label>
          <input name="city" placeholder="City" value=<?= '"' . $userData['city'] . '"' ?>>
          <br><br>
          <label>Password</label>
          <input name="password" type="password" placeholder="New password">
          <input name="passcheck" type="password" placeholder="Repeat new password">
          <br><br>
          <input id="saveUser" name="button" type="submit" value="Save Changes">
        </form>
        <script type="text/javascript" src="scripts/edit_user.js"></script>
        <link rel="stylesheet" href="style/edit_user_style.css">
        </div>
        <?php
        return;
      }
    }
  }
  header("Location: index.php");
 ?>
</div>