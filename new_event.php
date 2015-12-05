<?php session_start();
  if(!isset($_SESSION['username']))
    header('Location: login.php');
  include_once('templates/header.php');
  include_once('templates/new_event.php');
  include_once('templates/footer.php');
?>
  </body>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="scripts/new_event_script.js"></script>
    <link rel="stylesheet" href="templates/new_event.css"> 
</html>
