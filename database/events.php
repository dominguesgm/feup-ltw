<?php
include_once('connection.php');

// add event to Events database and to user's list of events
function createEvent($username, $nameTag, $type, $description, $time, $city, $address, $imageURL, $publicEvent){
	global $db;

	// create event
	$stmt = $db->prepare('INSERT INTO Event(id, creator, nameTag, type, description, time, city, address, imageURL, publicEvent)
								values (NULL, :creator, :nameTag, :type, :description, :time, :city, :address, :imageURL, :publicEvent)');

	$stmt->bindParam(':creator', $username, PDO::PARAM_STR);
	$stmt->bindParam(':nameTag', $nameTag, PDO::PARAM_STR);
	$stmt->bindParam(':type', $type, PDO::PARAM_STR);
	$stmt->bindParam(':description', $description, PDO::PARAM_STR);
	$stmt->bindParam(':time', $time, PDO::PARAM_STR);
	$stmt->bindParam(':city', $city, PDO::PARAM_STR);
	$stmt->bindParam(':address', $address, PDO::PARAM_STR);
	$stmt->bindParam(':imageURL', $imageURL, PDO::PARAM_STR);
	$stmt->bindParam(':publicEvent', $publicEvent, PDO::PARAM_STR);

	try{
    	$stmt->execute();
  	} catch(PDOException $e) {
    	return -1;
  	}

  	//get event id
	$stmt = $db->prepare('SELECT id FROM Event ORDER BY id DESC');
	try{
  	$stmt->execute();
		$result = $stmt->fetch();
		$eventId = $result['id'];
  } catch(PDOException $e) {
  	return -2;
  }

	$stmt = $db->prepare('INSERT INTO Attending (username, eventId) values (:username, :eventId)');

	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	$stmt->bindParam(':eventId', $eventId, PDO::PARAM_STR);
	try{
 		$stmt->execute();
		return $eventId;
	} catch(PDOException $e) {
  	return -3;
	}
}

// updates the event's information to the given parameters
function updateEvent($id, $username, $nameTag, $type, $description, $time, $city, $address, $imageURL, $publicEvent){
	global $db;

	$stmt = $db->prepare('UPDATE Event SET nameTag=:nameTag, type=:type, description=:description, time=:time, city=:city, address=:address, imageURL=:imageURL, publicEvent=:publicEvent WHERE id=:id AND creator=:creator');

	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->bindParam(':creator', $username, PDO::PARAM_STR);
	$stmt->bindParam(':nameTag', $nameTag, PDO::PARAM_STR);
	$stmt->bindParam(':type', $type, PDO::PARAM_STR);
	$stmt->bindParam(':description', $description, PDO::PARAM_STR);
	$stmt->bindParam(':time', $time, PDO::PARAM_STR);
	$stmt->bindParam(':city', $city, PDO::PARAM_STR);
	$stmt->bindParam(':address', $address, PDO::PARAM_STR);
	$stmt->bindParam(':imageURL', $imageURL, PDO::PARAM_STR);
	$stmt->bindParam(':publicEvent', $publicEvent, PDO::PARAM_STR);

	try{
   		$stmt->execute();
   		return true;
  	} catch(PDOException $e) {
    	return false;
  	}
}

// delete the event with the given id from the database
function deleteEvent($id, $username){
	global $db;

	$stmt = $db->prepare('DELETE FROM Event WHERE id=:id');
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->bindParam(':creator', $username, PDO::PARAM_STR);

	try{
   		$stmt->execute();
   		return true;
  	} catch(PDOException $e) {
    	return false;
  	}
}

function attendEvent($username, $eventID, $attend = false){
	// open database
	global $db;

	if($attend){
		// attend event
		$stmt = $db->prepare('INSERT INTO Attending(username, eventID)
							values (:username, :eventID)');
	}else{
		// do not attend event
		$stmt = $db->prepare('DELETE FROM Attending WHERE username=:username, username=:eventID');
	}

	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);

	try{
   		$stmt->execute();
   		return true;
  	} catch(PDOException $e) {
    	return false;
  	}
}

function getEvent($eventID, $username){
	// open database
	global $db;

	if(!isset($username)){
		$stmt = $db->prepare('SELECT * FROM  Event WHERE id = :eventID');
	}else{
		$stmt = $db->prepare('SELECT * FROM  Event WHERE id = :eventID AND creator = :username');
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	}
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);

	try{
   		$stmt->execute();
   		return $stmt->fetch();
  	} catch(PDOException $e) {
    	return false;
  	}
}

// return all events
function getEvents($username){
	// open database
	global $db;

	if(!isset($username)){
		$stmt = $db->prepare('SELECT * FROM  Event WHERE publicEvent = 1');
	}else{
		$stmt = $db->prepare('SELECT * FROM  Event WHERE publicEvent = 1 OR creator = :username');
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	}

	try{
   		$stmt->execute();
   		return $stmt->fetchAll();
  	} catch(PDOException $e) {
    	return false;
  	}
}

// return all events on a city
function getEventsByCity($city, $username){
	// open database
	global $db;

	if(!isset($username)){
		$stmt = $db->prepare('SELECT * FROM  Event WHERE publicEvent = 1 AND city=:city');
	}else{
		$stmt = $db->prepare('SELECT * FROM  Event WHERE city=:city AND (publicEvent = 1 OR creator = :username)');
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	}

	$stmt->bindParam(':city', $city, PDO::PARAM_STR);

	try{
   		$stmt->execute();
   		return $stmt->fetchAll();
  	} catch(PDOException $e) {
    	return false;
  	}
}

// return user events
function getUserEvents($username){
	// open database
	global $db;

	$stmt = $db->prepare('SELECT * FROM  Event WHERE creator = :username');
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);

	try{
   		$stmt->execute();
   		return $stmt->fetchAll();
  	} catch(PDOException $e) {
    	return false;
  	}
}

// Search for events related with the string var
function getEventsSearch($var){
	// open database
	global $db;

	$var = '%' . $var . '%';

	$stmt = $db->prepare('SELECT * FROM Event WHERE publicEvent = 1 AND (type LIKE :var OR city LIKE :var OR nameTag LIKE :var OR description LIKE :var OR creator LIKE :var) ORDER BY id DESC');

	$stmt->bindParam(':var', $var, PDO::PARAM_STR);

	try{
   		$stmt->execute();
   		return $stmt->fetchAll();
  	} catch(PDOException $e) {
    	return false;
  	}
}

// return events the user is attending
function getLimitedUserAttendance($username, $maxEvents = 3){
	// open database
	global $db;

	$stmt = $db->prepare('SELECT * FROM  Event WHERE id in (SELECT eventId FROM Attending WHERE username = :username ORDER BY eventId DESC LIMIT :maxEvents)');

	$stmt->bindParam(':maxEvents', $maxEvents, PDO::PARAM_INT);
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);

	try{
   		$stmt->execute();
   		return $stmt->fetchAll();
  	} catch(PDOException $e) {
    	return false;
  	}
}

// return events the user is attending
function getLimitedUserCreations($username, $maxEvents = 3){
	// open database
	global $db;

	$stmt = $db->prepare('SELECT * FROM Event WHERE creator = :creator ORDER BY id DESC LIMIT :maxEvents');

	$stmt->bindParam(':maxEvents', $maxEvents, PDO::PARAM_INT);
	$stmt->bindParam(':creator', $username, PDO::PARAM_STR);

	try{
   		$stmt->execute();
   		return $stmt->fetchAll();
  	} catch(PDOException $e) {
    	return false;
  	}
}


?>
