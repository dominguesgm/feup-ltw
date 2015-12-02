<html>
  <head>
    <title>EventNetwork</title>
    <meta charset="UTF-8">
    <link rel="stylesheed" href="templates/header.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  </head>
  <body>
    <div id="floatingHeader">
      <a href="./">Home</a>
      <a href="./new_event.php">Create Event</a>
      <input id="search" type="text" name="search" placeholder="Events & Users" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>"/>
      <?php echo '<a id="user" href="?user=' . $_SESSION['username'] . '">' . $_SESSION['username'] . '</a>'?>
      <a href="database/action_logout.php">Logout</a>
    </div>
