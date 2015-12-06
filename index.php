<?php session_start();
  if(!isset($_SESSION['username']))
    header("Location: login.php");
  include('templates/header.php');
?>
<?php
  if(isset($_GET['search']) && !isset($_GET['event']) && !isset($_GET['user'])){
    // In the case of a search
    //new function for events, get 10 events starting on result x
    ?><div id="listEvents" class="displayEvents">
      <h2>Search Results for '<?=$_GET['search']?>'</h2>
      <?php
        include("database/events.php");
        include_once("templates/display_event.php");
        $finalSearch = getEventsSearch($_GET['search'], $_SESSION['username']);    // print search result
        for($i = 0; $i < count($finalSearch); $i++){
          displaySmallEvent($finalSearch[$i]);
        }
      ?>
    </div><?php

  } else {
    if(isset($_GET['user']) && !isset($_GET['search']) && !isset($_GET['event'])){
      // In the case of a user page
      ?><div id="userPage">
        <div id="userHolder" class="contentHolder" data-user="<?=$_GET['user']?>">
          <?php include_once("database/user_data.php");
              include_once("database/events.php");
              include_once("templates/user_page.php");?>
        </div>
      </div>
      <script type="text/javascript" src="scripts/user_page.js"></script>
      <link rel="stylesheet" href="style/user_page_style.css">
      <?php } else {
      if(isset($_GET['event']) && !isset($_GET['user']) && !isset($_GET['search'])){
        // In the case of an event page
        ?>
        <div id="eventHolder" class="contentHolder"><?php
          include_once('database/events.php');
          include_once('database/comments.php');

          $event = getEvent($_GET['event']);

          if ($event){
            if($event['publicEvent']==1 || $event['creator']==$_SESSION['username'] || isInvitedToEvent($_SESSION['username'], $event['id'])){
              $invites = invitesForEvent($_GET['event']);
              $comments = getEventComments($_GET['event']);

              include_once("templates/view_event.php");
              include_once("templates/list_comments.php");
            } else {
              echo "<p>You do not have permission to view this event.</p>";
            }
          } else {
            echo "<p>The event you're looking for does not exist.</p>";
          }?>
        </div>
        <script type="text/javascript" src="scripts/event_item.js"></script>
        <link rel="stylesheet" href="style/event_item_style.css"><?php
        
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
