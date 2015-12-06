<?php
session_start();
include_once('connection.php');
$body = file_get_contents('php://input');
if(isset($body)){
  $json = json_decode($body, true);

  date_default_timezone_set("UTC");
  $currentDate = date("Y-m-d H:i");

  if(isset($json['attended']))
    $stmt = $db->prepare("SELECT id, nameTag, creator, type, description, time, city, address, imageURL, publicEvent FROM Event, Attending WHERE eventId = id AND username = :username AND datetime(time) < datetime( :currentDate ) ORDER BY datetime(time) DESC");
  $stmt->bindParam(":username", $_SESSION['username'], PDO::PARAM_STR);
  $stmt->bindParam(":currentDate", $currentDate, PDO::PARAM_STR);

  try{
    $stmt->execute();
    $result = $stmt->fetchAll();
  }catch(PDOException $e){
    echo json_encode(array("error" => "Error on query"));
    return;
  }


  if(count($result) == 0)
    echo json_encode(array("empty" => "No events to attend"));
  else
    echo json_encode($result);

}
//TODO test

?>
