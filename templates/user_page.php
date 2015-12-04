<?php
$data;
if(isset($result['same'])) $data = $result['same'];
if(isset($result['different'])) $data = $result['different'];
if(isset($result['same']) || isset($result['different'])){
    $attendance = getLimitedUserAttendance($data['username'], 4, 0);
    $creations = getLimitedUserCreations($data['username'], 4, 0);
   ?><h3><?=$data['name']?></h3>
     <p>City: <?=$data['city']?></p>
     <p>Email: <?=$data['email']?></p>
  <?php if($data["phoneNumber"] != "" && $data['phoneNumber'] != null){ ?>
     <p>Phone Number: <?=$data['phoneNumber']?></p>
  <?php } if(isset($result['same'])){ ?>
     <form method='post' action='edit_user.php'>
       <input name='username' type='text' value='<?=$data['username']?>' hidden>
       <input value='Edit' type='submit'></form>
  <?php } ?>
      <!-- Events user is attending -->
      <h3>Future events <?=$data['name']?> will attend</h3>
      <div id="attendance" class="events">
      <?php if(count($attendance) > 0){
        $count = (count($attendance) < 4) ? count($attendance) : 3;
        for($i = 0; $i < $count; $i++){?>
          <div class="singleEvent">
            <h4><a href="./?event=<?=$attendance[$i]['id']?>"><?=$attendance[$i]['nameTag']?></a></h4>
            <p><?=$attendance[$i]['type']?> in <?=$attendance[$i]['city']?></p>
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
        for($i = 0; $i < count($creations); $i++){?>
          <div class="singleEvent">
            <h4><a href="./?event=<?=$creations[$i]['id']?>"><?=$creations[$i]['nameTag']?></a></h4>
            <p><?=$creations[$i]['type']?> in <?=$creations[$i]['city']?></p>
          </div>
        <?php }
        if(count($creations) == 4){?>
          <button>Show More</button>
        <?php }
      } else echo '<p>' . $data['name'] . '</p>'?></div>
<?php } else {?>
  <p>No user with this name was found in the database</p>
<?php } ?>
