<?php session_start();
  if(isset($_SESSION['username']))
    header("Location: index.php");?>
<html>
  <head>
    <title>EventNetwork</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <h2>Login</h2>
    <div id="error"></div>
      <form class="login">
        <input name="username" type="text" placeholder="Username"/>
        <input name="password" type="password" placeholder="Password"/>
        <input id="login" type="submit" value="Login"/>
      </form>
      <a href="register.php">Register</a>
  </body>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="scripts/authentication.js"></script>
</html>
