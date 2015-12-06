<!DOCTYPE html>
<html>
  <head>
    <title>EventNetwork</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style/header_style.css">
    <link rel="stylesheet" type="text/css" href="style/footer_style.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="scripts/main.js"></script>
  </head>
  <body>
    <div id="floatingHeader">
      <a class="myButton" href="./">Home</a>
      <a class="myButton" href="./new_event.php">Create Event</a>
      <input id="search" type="text" name="search" placeholder="Events & Users"/>
      <?php echo '<a id="user" class="myButton" href="./?user=' . $_SESSION['username'] . '">' . $_SESSION['username'] . '</a>'?>
      <a class="myButton" href="database/action_logout.php">Logout</a>
    </div>
