<?php 
include_once('database/connection.php');

// create a new user with the given parameters
function createUser($username, $password, $name, $city){
	user('CREATE', $username, $password, $name, $city);
}

// update the user's information to the given parameters
function updateUser($username, $password, $name, $city){
	user('UPDATE', $username, $password, $name, $city);
}

// delete the user with the given username from the database
function deleteUser($username, $password){
	user('DELETE', $username, $password);
}

// user operarions
function user($operation, $username, $password, $name, $city){
	// open database
	$db = openDB();

	switch($operation){
		// create new user
		case 'CREATE':	
			$stmt = $db->prepare('INSERT INTO User(username, password, name, city) 
								values (:username, :password, :name, :city)');
			break;
		case 'UPDATE':
			$stmt = $db->prepare('UPDATE User 
				SET password=:password, name=:name, city=:city
				WHERE username = :username');
			break;
		case 'DELETE':
			$stmt = $db->prepare('DELETE FROM User WHERE username=:username AND password=:password');
			$stmt->bindParam(':username', $username, PDO::PARAM_STRING);
			$stmt->bindParam(':password', $password, PDO::PARAM_STRING);
			$stmt->execute();
			return;
		default:
			return;
	}
	
	$stmt->bindParam(':username', $username, PDO::PARAM_STRING);
	$stmt->bindParam(':password', $password, PDO::PARAM_STRING);
	$stmt->bindParam(':name', $name, PDO::PARAM_STRING);
	$stmt->bindParam(':city', $city, PDO::PARAM_STRING);
	$stmt->execute();
}

// return user with given username and password
function getUser($username, $password){
	$db = openDB();
	$stmt = $db->prepare('SELECT * FROM User WHERE username = :username AND password=:password');
	$stmt->bindParam(':username', $username, PDO::PARAM_STRING);
	$stmt->bindParam(':password', $password, PDO::PARAM_STRING);
	$stmt->execute();
	return $stmt->fetch();
}

?>