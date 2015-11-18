<?php
  session_start();
  echo '<html><head><title>EventNetwork</title><meta charset="UTF-8"><link rel="stylesheed" href="templates/header.css"></head><body>';
  echo '<div id="floatingHeader">';
  if(!array_key_exists('username', $_SESSION)){
			echo '<form action="action_login.php" method="post">
				<label>Username</label>
				<input type="text" name="username"/>
				<label>Password</label>
				<input type="password" name="password"/>
				<input type="submit" value="Log In"/>
				</form>';
		} else {
			echo '<a href="action_logout.php">Log Out</a>';
		}
  echo '</div>';
  echo '</body></html>'; //used only for testing

 ?>
