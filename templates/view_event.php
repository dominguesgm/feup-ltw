<div class="event-item">
  <h3><?=$event['nameTag']?></h3>
  <h4><?=$event['type']?></h4>
  <h4>When: <?=$event['time']?></h4>
  <h4>Where: <?=$event['city']?></h4>
  <?php if($event['address'] != ""){?><h4>Where exactly: <?=$event['address']?></h4><?php } ?>
  <img src="<?=$event['imageURL']?>" alt="300x200">
  <h4><?=$event['description']?></h4>
  <ul>
    <?php
      if(isset($_SESSION['username'])) {
        if($event['creator']==$_SESSION['username']) { ?>
          <form action="edit_event.php" method="post">
            <button id="invite" type="button" onclick="inviteToEvent(<?=$event['id']?>)">Send invites</button>
            <input type="text" name="id" value="<?=$event['id']?>" hidden readonly>
            <input id="edit" type="submit" value="Edit">
            <button id="cancel" type="button" onclick="cancelEvent('<?=$_SESSION['username']?>', <?=$event['id']?>)">Cancel</button>
          </form>
    <?php } else { if(!isAttendingEvent($_SESSION['username'], $event['id'])) {?>
        <button id="attendance" type="button" onclick="attend('<?=$_SESSION['username']?>', <?=$event['id']?>)">Attend</button>
    <?php } else {?>
        <button id="attendance" type="button" onclick="attend('<?=$_SESSION['username']?>', <?=$event['id']?>)">Do not attend</button> <?php } } }?>
  </ul>
</div>
