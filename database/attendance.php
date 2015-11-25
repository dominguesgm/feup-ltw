<?php
include_once('connection.php');
function eventsUserisAttending($username){
  global $db;
  $stmt = $db->prepare("SELECT id, type, description, time, city, address, imageURL, publicEvent FROM Event, Attending WHERE eventId = id AND username = :username");
  $stmt->bindParam(":username", $username, PDO::PARAM_STR);

  try{
    $stmt->execute();
    $result = $stmt->fetchAll();
  }catch(PDOException $e){
    return $e->getMessage();
  }

  for($i = 0; $i < count($result); $i++){?>
    <div class="shortEvent">
      <?php echo '<h4>' . $result[$i]['type'] . '</h4>';
            echo '<h4>' . $result[$i]['city'] . '</h4>';
            echo '<h4>' . $result[$i]['time'] . '</h4>';
            echo '<h6>' . $result[$i]['address'] . '</h6>';
            echo '<p>' . $result[$i]['description'] . '</p>';
            if($result[$i]['imageURL'] != "")
                echo '<img src="' . $result[$i]['imageURL'] . '">'?>
    </div><?php
  }
}?>
