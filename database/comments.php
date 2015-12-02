<?php
include_once('connection.php');

function addCommentToEvent($username, $eventID, $time, $commentContent){
	// open database
	global $db;

	$stmt = $db->prepare('INSERT INTO Comment(id, username, eventId, time, commentContent) 
								values (NULL, :username, :eventID, :time, :commentContent)');
	$stmt->bindParam(':time', $time, PDO::PARAM_STR);
	$stmt->bindParam(':commentContent', $commentContent, PDO::PARAM_STR);
	$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	
	try{
   		$stmt->execute();
   		return true;
  	} catch(PDOException $e) {
    	return false;
  	}
}

function removeComment($commentId){
	// open database
	global $db;

	$stmt = $db->prepare('DELETE FROM Comment WHERE id=:commentId');
	$stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);
	
	try{
   		$stmt->execute();
   		return true;
  	} catch(PDOException $e) {
    	return false;
  	}
}

function getEventComments($eventID){
	// open database
	global $db;

	$stmt = $db->prepare('SELECT * FROM Comment WHERE eventID=:eventID');
	$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
	$stmt->execute();

	try{
   		$stmt->execute();
   		return $stmt->fetchAll();
  	} catch(PDOException $e) {
    	return false;
  	}
}

?>