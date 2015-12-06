<div id="user_page">
    <br>
    <img src="res/user.png" width="60" height="60"> <br>
<?php
$data;
  if(isset($result['same'])) $data = $result['same'];

  if(isset($result['different'])) $data = $result['different'];

  if(isset($result['same']) || isset($result['different'])){
    $attendance = getLimitedUserAttendance($data['username'], 4, 0);
    $creations = getLimitedUserCreations($data['username'], 4, 0);
   ?>

   <h3><?=$data['name']?></h3>

   <h4>City</h4><label><?=$data['city']?></label>
   <h4>Email </h4><label><?=$data['email']?></label>

  <?php if($data["phoneNumber"] != "" && $data['phoneNumber'] != null){ ?>
     <h4>Contact </h4><label><?=$data['phoneNumber']?></label>
  <?php } if(isset($result['same'])){ ?>
      <br><br>
     <form id="editForm" method='post' action='edit_user.php'>
       <input name='username' type='text' value='<?=$data['username']?>' hidden>
       <input id='editUser' value='Edit account' type='submit'></form>

      <form id="deleteForm" method='post' action='database/action_delete_user.php'>
       <input name='username' type='text' value='<?=$data['username']?>' hidden>
       <input id='deleteUser' value='Cancel account' type='submit'></form>
  <?php } ?>

      <!-- Events user is attending -->
      <h3>Upcoming events <?=$data['name']?> will attend</h3>
      <div id="attendance" class="events">
      <?php if(count($attendance) > 0){
        $count = (count($attendance) < 4) ? count($attendance) : 3;
        for($i = 0; $i < $count; $i++){?>
          <div class="singleEvent">
            <img src="images/thumbs_small/<?=$attendance[$i]['imageURL']?>" width="50" height="50">
            <h4><a href="./?event=<?=$attendance[$i]['id']?>"><?=$attendance[$i]['nameTag']?></a></h4>
            <p class="eventDesc"><?=$attendance[$i]['type']?> in <?=$attendance[$i]['city']?></p>
          </div>
        <?php }
        if(count($attendance) == 4){?>
          <button>Show More</button>
        <?php }
      } else echo '<p>' . $data['name'] . '</p>'?></div>

      <!-- Events created by user -->
      <h3>Events created by <?=$data['name']?></h3>
      <div id="creations" class="events">
      <?php if(count($creations) > 0){
        $count = (count($creations) < 4) ? count($creations) : 3;
        for($i = 0; $i < $count; $i++){?>
          <div class="singleEvent">
            <img src="images/thumbs_small/<?=$creations[$i]['imageURL']?>" width="50" height="50">
            <h4><a href="./?event=<?=$creations[$i]['id']?>"><?=$creations[$i]['nameTag']?></a></h4>
            <p class="eventDesc"><?=$creations[$i]['type']?> in <?=$creations[$i]['city']?></p>
          </div>
        <?php }
        if(count($creations) == 4){?>
          <button>Show More</button>
        <?php }
      } else echo '<p>' . $data['name'] . '</p>'?></div>
<?php } else {?>
  <p>No user with this name was found in the database...</p>
<?php } ?>
</div>
