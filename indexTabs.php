<?php session_start();
  if(!array_key_exists('username', $_SESSION)){
    //produce main user page
  }
?>
<html>
  <head>
    <title>EventNetwork</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="templates/authTabs.css">
  </head>
  <body>
    <div id="authenticationBox">
      <ul id="tab">
        <li id="register">Register</li>
        <li id="login">Login</li>
      </ul>
      <div id="form"></div>
    </div>
  </body>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="scripts/authentication.js"></script>
</html>
