<div id="event_item" class="event-item">
  <br>
  <img id="image" src="images/thumbs_medium/<?=$event['imageURL']?>" width="250" height="250">
  <div id="event_info">
    <h2><?=$event['nameTag']?></h3>
    <h4><?=$event['type']?></h4>
    <h4>When? <label><?php echo str_replace("T",", ",$event['time']) ?></label></h4>
    <h4>Where? <label> <?=$event['city']?><?php if($event['address'] != ""){?>, <?=$event['address']?><?php } ?></label>
    </h4>
    <?php if($event['description'] != ""){?>
        <h4>About...</h4>
        <p><?=$event['description']?></p>
    <?php } ?>
  </div>
  <div id="options">
    <?php
        if($event['creator']==$_SESSION['username'] && !hasEventHappened($_GET['event'])) { ?>
          <div class="warning" id="inviteWarning"></div>
          <button id="invite" data-event="<?=$event['id']?>" type="button">Invite</button>
          <br><br>
          <form action="edit_event.php" method="post">
            <input type="text" name="id" value="<?=$event['id']?>" hidden readonly>
            <input id="edit" type="submit" value="Edit">
          </form>
          <button id="cancel" type="button" onclick="cancelEvent('<?=$_SESSION['username']?>', <?=$event['id']?>, '<?=$event['imageURL']?>')">Cancel</button>
          <h4>Already invited: </h4>
          <ul id="usersInvited">
            <?php if(count($invites) == 0){
              echo '<li data-user="none">No user has been invited yet</li>';
            }
              for($i = 0; $i < count($invites); $i++){
                    echo '<li data-user="' . $invites[$i]['username'] . '" data-event="' . $event['id'] . '"><a href="./?user=' . $invites[$i]['username'] . '">' . $invites[$i]['username'] . '</a> <img class="removeInvite" src="res/cross.png" width="8" height="8"></li>';
            }?>
          </ul>
    <?php } else { if(!hasEventHappened($_GET['event'])) {
        if(!isAttendingEvent($_SESSION['username'], $event['id'])) {?>
        <button id="attendance" type="button" onclick="attend('<?=$_SESSION['username']?>', <?=$event['id']?>)">Attend</button>
        <?php } else {?>
        <button id="attendance" type="button" onclick="attend('<?=$_SESSION['username']?>', <?=$event['id']?>)">Do not attend</button> <?php } } }?>
        <h4 id="usersAttending">Going:</h4>
        <ul id="attendance">
          <button id="showAttendance" data-event="<?=$event['id']?>">Show attendance</button>
        </ul>
  </div>
</div>
