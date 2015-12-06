<?php session_start();
  if(!isset($_SESSION['username']))
    header("Location: login.php");
  include('templates/header.php');
?>
<?php
  if(isset($_GET['search']) && !isset($_GET['event']) && !isset($_GET['user'])){
    // In the case of a search
    //new function for events, get 10 events starting on result x
    ?><div id="listEvents" class="displayEvents" data-query="<?=$_GET['search']?>" data-user="<?=$_SESSION['username']?>">
      <img class="waiting" src="res/search.png" width="50" height="50">
      <h2>Search Results for '<?=$_GET['search']?>'...</h2>
      <?php
        include("database/events.php");
        include_once("templates/display_event.php");
        $finalSearch = getEventsSearch($_GET['search'], $_SESSION['username'], 3, 0);    // print search result
        if(count($finalSearch)){
          for($i = 0; $i < count($finalSearch); $i++){
            displaySmallEvent($finalSearch[$i]);
          }
        } else echo '<p class="text">No events match the search parameters...</p>';
      ?>
    </div>
    <link rel="stylesheet" href="style/search_page_style.css">
    </div><script type="text/javascript" src="scripts/search.js"></script><?php

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
              echo "<p class='noEvent'>You do not have permission to view this event.</p>";
            }
          } else {
            echo "<p class='noEvent'>The event you're looking for does not exist.</p>";
          }?>
        </div>
        <script type="text/javascript" src="scripts/event_item.js"></script>
        <link rel="stylesheet" href="style/event_item_style.css"><?php

      } else {?>
        <br>
        <div id="attending" class="displayEvents">
          <img class="icon" src="res/attending.png" width="50" height="50">
          <h1>Events you are attending...</h1>
          <?php include_once("database/events.php");
          include("templates/coming_events.php");?>
        </div>
        <br>
        <div id="attended" class="displayEvents">
          <img class="icon" src="res/attended.png" width="50" height="50">
          <h1>Events you attended...</h1>
          <button id="loadAttendedEvents">Show events attended</button>
        </div>
        <script type="text/javascript" src="scripts/listattendance.js"></script>
        <link rel="stylesheet" href="style/index_page_style.css">
        <?php
      }
    }
  }?>
  </body>
</html>
