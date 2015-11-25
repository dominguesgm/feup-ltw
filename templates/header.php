<html>
  <head>
    <title>EventNetwork</title>
    <meta charset="UTF-8">
    <link rel="stylesheed" href="templates/header.css">
  </head>
  <body>
    <div id="floatingHeader">
      <a href="./">Home</a>
      <a href="./new_event.php">Create Event</a>
      <input id="search" type="text" name="search" placeholder="Events & Users" />
      <?php echo '<a href="?page=' . $_SESSION['username'] . '">' . $_SESSION['username'] . '</a>'?>
      <a href="database/action_logout.php">Logout</a>
    </div>
