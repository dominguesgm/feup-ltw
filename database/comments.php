<?php
include_once('database/connection.php');

function addCommentToEvent($username, $eventID, $time, $commentContent){
	// open database
	global $db;

	$stmt = $db->prepare('INSERT INTO Comment(id, username, eventID, time, commentContent) 
								values (NULL, :username, :eventID, :time, :commentContent)');
	$stmt->bindParam(':time', $time, PDO::PARAM_STRING);
	$stmt->bindParam(':commentContent', $commentContent, PDO::PARAM_STRING);
	$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
	$stmt->bindParam(':username', $username, PDO::PARAM_STRING);
	$stmt->execute();
}

function removeComment($commentId){
	// open database
	global $db;

	$stmt = $db->prepare('DELETE FROM Comment WHERE id=:commentId');
	$stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);
	$stmt->execute();
}

function getEventComments($eventID){
	// open database
	global $db;

	$stmt = $db->prepare('SELECT * FROM Comment WHERE eventID=:eventID');
	$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();
}

?>