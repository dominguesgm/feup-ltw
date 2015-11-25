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
      <form class="register">
        <input name="username" type="text" placeholder="Username"/>
        <input name="password" type="password" placeholder="Password"/>
        <input name="email" type="email" placeholder="Email"/>
        <input name="fullName" type="text" placeholder="Name"/>
        <input name="phoneNumber" type="text" placeholder="Phone Number (optional)"/>
        <input name="city" type="text" placeholder="City"/>
        <input name="register" type="submit" value="Register"/>
      </form>
      <a href="Login.php">Login</a>
  </body>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="scripts/authentication.js"></script>
</html>
