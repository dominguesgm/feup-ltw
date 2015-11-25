<?php

  include_once('connection.php');

  $stmt = $db->prepare('SELECT * FROM EventType');
  $stmt->execute();  
  $types = $stmt->fetchAll();

  $result = array();
  foreach ($types as $type)
    $result[] = $type['eventType'];    

  echo json_encode($result);

?>