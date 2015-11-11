<?php 
include_once('database/connection.php');

// create a new user with the given parameters
function createUser($username, $password, $name, $address, $zip1, $zip2){
	user('CREATE', $username, $password, $name, $address, $zip1, $zip2);
}

// update the user's information to the given parameters
function updateUser($username, $password, $name, $address, $zip1, $zip2){
	user('UPDATE', $username, $password, $name, $address, $zip1, $zip2);
}

// delete the user with the given username from the database
function deleteUser($username, $password){
	user('DELETE', $username, $password);
}

// user operarions
function user($operation, $username, $password, $name, $address, $zip1, $zip2){
	// open database
	$db = openDB();

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
			$stmt->bindParam(':password', $password, PDO::PARAM_STRING);
			$stmt->execute();
			return;
		default:
			return;
	}
	
	$stmt->bindParam(':username', $username, PDO::PARAM_STRING);
	$stmt->bindParam(':password', $password, PDO::PARAM_STRING);
	$stmt->bindParam(':name', $name, PDO::PARAM_STRING);
	$stmt->bindParam(':address', $address, PDO::PARAM_STRING);
	$stmt->bindParam(':zip1', $zip1, PDO::PARAM_INT);
	$stmt->bindParam(':zip2', $zip2, PDO::PARAM_INT);
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