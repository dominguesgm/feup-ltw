<?php session_start();
  if(!isset($_SESSION['username']))
    header("Location: login.php");
  include('templates/header.php');
?>
<?php
  if(isset($_GET['search'])){
    //new function for events, get 10 events starting on result x
  } else {
    if(isset($_GET['user'])){

    } else {
      if(isset($_GET['event'])){

      } else {?>
        <div id="attending" class="displayEvents">
          <img src="res/loading.gif">
        </div>
        <div id="attended" class="displayEvents">
          <button id="loadAttendedEvents">Events Atended</button>
        </div><?php
      }
    }
  }?>
  </body>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="scripts/main.js"></script>
  <script type="text/javascript" src="scripts/listattendance.js"></script>
</html>
