<?php
include_once('connection.php');
function eventsUserisAttending($username){
  global $db;
  $stmt = $db->prepare("SELECT id, nameTag, creator, type, description, time, city, address, imageURL, publicEvent FROM Event, Attending WHERE eventId = id AND username = :username");
  $stmt->bindParam(":username", $username, PDO::PARAM_STR);

  try{
    $stmt->execute();
    $result = $stmt->fetchAll();
  }catch(PDOException $e){
    return $e->getMessage();
  }

  for($i = 0; $i < count($result); $i++){?>
    <div class="shortEvent">
      <?php echo '<h2>' . $result[$i]['nameTag'] . '</h2>';
            echo '<h4>By: ' . $result[$i]['creator'] . '</h4>';
            echo '<h4>What: ' . $result[$i]['type'] . '</h4>';
            echo '<h4>Where: ' . $result[$i]['city'] . '</h4>';
            echo '<h4>When: ' . $result[$i]['time'] . '</h4>';
            echo '<h6>Where exactly: ' . $result[$i]['address'] . '</h6>';
            echo '<p>Description: ' . $result[$i]['description'] . '</p>';
            if($result[$i]['imageURL'] != "")
                echo '<img src="' . $result[$i]['imageURL'] . '">'?>
    </div><?php
  }
}?>
