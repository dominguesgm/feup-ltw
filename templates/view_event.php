<div class="event-item">
  <h3><?=$event['nameTag']?></h3>
  <h4><?=$event['type']?></h4>
  <h4>When: <?=$event['time']?></h4>
  <h4>Where: <?=$event['city']?></h4>
  <?php if($event['address'] != ""){?><h4>Where exactly: <?=$event['address']?></h4><?php } ?>
  <img src="<?=$event['imageURL']?>" alt="300x200">
  <p>Description: <?=$event['description']?></p>

    <?php
      if(isset($_SESSION['username'])) {
        if($event['creator']==$_SESSION['username']) { ?>
          <div class="warning" id="inviteWarning"></div>
          <button id="invite" type="button" onclick="inviteToEvent(<?=$event['id']?>)">Send invites</button>
          <form action="edit_event.php" method="post">
            <input type="text" name="id" value="<?=$event['id']?>" hidden readonly>
            <input id="edit" type="submit" value="Edit">
          </form>
          <button id="cancel" type="button" onclick="cancelEvent('<?=$_SESSION['username']?>', <?=$event['id']?>, '<?=$event['imageURL']?>')">Cancel</button>
          <h4>Users Invited: </h4>
          <ul id="usersInvited">
            <?php for($i = 0; $i < count($invites); $i++){
                    echo '<li data-user="' . $invites[$i]['username'] . '" data-event="' . $event['id'] . '">' . $invites[$i]['username'] . ' <img class="removeInvite" src="res/cross.png" width="8" height="8"></li>';
            }?>
          </ul>
    <?php } else { if(!isAttendingEvent($_SESSION['username'], $event['id'])) {?>
        <button id="attendance" type="button" onclick="attend('<?=$_SESSION['username']?>', <?=$event['id']?>)">Attend</button>
    <?php } else {?>
        <button id="attendance" type="button" onclick="attend('<?=$_SESSION['username']?>', <?=$event['id']?>)">Do not attend</button> <?php } } }?>

        <h4>Users Going: </h4>
        <ul id="attendance">
          <button id="showAttendance">Show Attendance</button>
        </ul>

</div>
