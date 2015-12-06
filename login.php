<?php session_start();
  if(isset($_SESSION['username']))
    header("Location: index.php");?>
<html>
  <head>
    <title>EventNetwork</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style/login_style.css">
  </head>
  <body>
    <div class="login_div">
    <img src="res/logo.jpg" width="200" height="200">
    <h2>Login</h2>
    <div id="error"></div>
      <form class="login">
        <input name="username" type="text" placeholder="Username"/>
        <input name="password" type="password" placeholder="Password"/>
        <br><br>
        <input id="login" type="submit" value="Login"/>
      </form>
      <a id="registerLink" href="register.php">Register</a>
    </div>
  </body>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="scripts/authentication.js"></script>
  <link rel="stylesheet" href="style/login_style.css">
</html>
