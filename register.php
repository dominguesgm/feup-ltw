
<?php session_start();
  if(isset($_SESSION['username']))
    header("Location: index.php");?>
<html>
  <head>
    <title>EventNetwork</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <div id="register_form">
    <h2>Register</h2>
      <form class="register">
        <label>Username*</label>
        <input name="username" type="text" placeholder="Username"/>
        <br><br>
        <label>Password*</label>
        <input name="password" type="password" placeholder="Password"/>
        <input name="passcheck" type="password" placeholder="Repeat password" />
        <br><br>
        <label>Email*</label>
        <input name="email" type="email" placeholder="Email"/>
        <br><br>
        <label>Full name*</label>
        <input name="name" type="text" placeholder="Name"/>
        <br><br>
        <label>Phone number</label>
        <input name="phoneNumber" type="text" placeholder="Phone Number (optional)"/>
        <br><br>
        <label>City*</label>
        <input name="city" type="text" placeholder="City"/>
        <br><br>
        <div id="error"></div>
        <input id="registerButton" name="register" type="submit" value="Register"/>
      </form>
      <a class="loginLink" href="Login.php">Login</a>
      </div>
  </body>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="scripts/authentication.js"></script>
  <link rel="stylesheet" href="style/register_user_style.css">
</html>