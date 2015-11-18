<?php session_start();
  if(!isset($_SESSION['username'])){
    header("Location: login.php")?>
<html>
  <head>
    <title>EventNetwork</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <div id="authenticationBox">
      <ul id="tab">
        <li id="register"><h2>Register</h2></li>
        <li id="login"><h2>Login</h2></li>
      </ul>
      <div id="form"><form action="database/action_login.php" method="post"><input name="username" type="text" placeholder="Username"/><input name="password" type="password" placeholder="Password"/><input id="submit" type="button" value="Login"/></form></div>
    </div>
    <a href="register.php">Register</a>
  </body>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="scripts/authentication.js"></script>
</html>
<?php } ?>