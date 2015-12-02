<?php session_start();
  if(!isset($_SESSION['username']))
    header('Location: login.php');
  include_once('templates/header.php');

  include_once('database/events.php');
  $event = getEvent($_POST['id'], $_SESSION['username']);

  if (!$event) die();

  include_once('templates/edit_event.php');
  include_once('templates/footer.php');
?>
  </body>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="scripts/edit_event_script.js"></script>
</html>
