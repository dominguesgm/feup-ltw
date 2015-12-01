<?php session_start();
  if(!isset($_SESSION['username']))
    header("Location: login.php");
  include('templates/header.php');
?>
<?php
  if(isset($_GET['search'])){
    // In the case of a search
    //new function for events, get 10 events starting on result x
    ?><script type="text/javascript" src="scripts/event_search.js"></script>
    <div id="listEvents" class="displayEvents">
      <h2>Search Results</h2>
    </div><?php

  } else {
    if(isset($_GET['user'])){
      // In the case of a user page
      ?><script type="text/javascript" src="scripts/user_page.js"></script>
      <div id="userHolder" class="contentHolder">
        <h2><?php echo $_GET['user'] ?></h2>
      </div><?php

    } else {
      if(isset($_GET['event'])){
        // In the case of an event page
        ?><script type="text/javascript" src="scripts/event_page.js"></script>
        <div id="eventHolder" class="contentHolder">
          <h2>Search Results</h2>
        </div><?php

      } else {?>
        <div id="attending" class="displayEvents">
          <h1>Events you are going to attend</h1>
          <img src="res/loading.gif">
        </div>
        <div id="attended" class="displayEvents">
          <h1>Events you attended</h1>
          <button id="loadAttendedEvents">Events Atended</button>
        </div>
        <script type="text/javascript" src="scripts/listattendance.js"></script>
        <?php
      }
    }
  }?>
  </body>
  <script type="text/javascript" src="scripts/main.js"></script>
</html>
