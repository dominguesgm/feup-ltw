<?php session_start();
  if(!isset($_SESSION['username']))
    header("Location: login.php");
  include('templates/header.php');
  include('database/attendance.php');
?>
<?php
  if(isset($_GET['search'])){
    //new function for events, get 10 events starting on result x
  } else {

  }
  eventsUserIsAttending($_SESSION['username']);?>
  </body>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="scripts/main.js"></script>
</html>
