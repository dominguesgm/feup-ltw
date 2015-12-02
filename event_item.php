<?php
  session_start();

  if(!isset($_SESSION['username']))
    header('Location: login.php');

  include_once('templates/header.php');
  include_once('database/events.php');
  include_once('database/comments.php');

  $event = getEvent($_GET['id']);
  $comments = getEventComments($_GET['id']);

  if (!$event) die();

  if(!($event['publicEvent']==1 || $event['creator']==$_SESSION['username'] || isInvited($_SESSION['username'], $event['id'])))
    die();

  include_once("templates/view_event.php");
  include_once("templates/list_comments.php");  
  include_once('templates/footer.php');
?>
  </body>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="scripts/event_item.js"></script>
</html>
