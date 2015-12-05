<?php session_start();
  if(isset($_SESSION['username']))
    header("Location: index.php");?>
<html>
  <head>
    <title>EventNetwork</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <h2>Register</h2>
    <div id="error"></div>
      <form class="register">
        <label>Username*</label>
        <input name="username" type="text" placeholder="Username"/>
        <label>Password*</label>
        <input name="password" type="password" placeholder="Password"/>
        <label>Repeat Password*</label>
        <input name="passcheck" type="password" placeholder="Repeat Password" />
        <label>Email*</label>
        <input name="email" type="email" placeholder="Email"/>
        <label>Full Name*</label>
        <input name="name" type="text" placeholder="Name"/>
        <label>Phone Number</label>
        <input name="phoneNumber" type="text" placeholder="Phone Number (optional)"/>
        <label>City*</label>
        <input name="city" type="text" placeholder="City"/>
        <input name="register" type="submit" value="Register"/>
      </form>
      <a href="Login.php">Login</a>
  </body>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="scripts/authentication.js"></script>
</html>
