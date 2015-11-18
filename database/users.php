<?php
include_once('connection.php');

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

// Detects if user exists in the database
function userExists($username, $password){
	$stmt = $db->prepare('SELECT user FROM User WHERE username = :username AND password = :password');

	$secure_password = sha1($password);
	$stmt->bindParam(':username', $username, PARAM_STRING);
	$stmt->bindParam(':password', $secure_password, PARAM_STRING);
	$stmt->execute();
	$result = $stmt->fetch();
	if($result['username'] != $username)
		return false;
	return true;
}

// user operarions
function user($operation, $username, $password, $name, $city){
	// open database
	$db = openDB();
	$secure_password = sha1($password);
	switch($operation){
		// create new user
		case "CREATE":
			$stmt = $db->prepare('INSERT INTO User(username, password, name, address, zipcode1, zipcode2)
								values (:username, :password, :name, :address, :zip1, :zip2)');
			break;
		case 'UPDATE':
			$stmt = $db->prepare('UPDATE User
				SET password=:password, name=:name, address=:address, zipcode1=:zipcode1, zipcode2=:zipcode2
				WHERE username = :username');
			break;
		case 'DELETE':
			$stmt = $db->prepare('DELETE FROM User WHERE username=:username AND password=:password');
			$stmt->bindParam(':username', $username, PDO::PARAM_STRING);
			$stmt->bindParam(':password', $secure_password, PDO::PARAM_STRING);
			$stmt->execute();
			return;
		default:
			return;
	}

	$stmt->bindParam(':username', $username, PDO::PARAM_STRING);
	$stmt->bindParam(':password', $secure_password, PDO::PARAM_STRING);
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
