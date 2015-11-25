<?php
include_once('connection.php');

// create a new user with the given parameters
function createUser($username, $password, $name, $city){
	global $db;
	$stmt = $db->prepare('INSERT INTO User(username, password, name, city) values (:username, :password, :name, :city)');
	$secure_password = hash("sha256", $password);
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	$stmt->bindParam(':password', $secure_password, PDO::PARAM_STR);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':city', $city, PDO::PARAM_STR);

	try{
    $stmt->execute();
		return true;
  } catch(PDOException $e) {
    return false;
  }
}

// update the user's information to the given parameters
function updateUser($username, $password, $name, $city){
	user('UPDATE', $username, $password, $name, $city);
}

// delete the user with the given username from the database
function deleteUser($username, $password){
	user('DELETE', $username, $password);
}

// Detects if user/password combination exists
function getUser($username, $password){
	global  $db;
	$stmt = $db->prepare('SELECT username FROM User WHERE username = :username AND password = :password');

	$secure_password = hash("sha256", $password);
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	$stmt->bindParam(':password', $secure_password, PDO::PARAM_STR);
	try{
    $stmt->execute();
		$result = $stmt->fetch();
		if($result['username'] != $username)
			return false;
		return true;
  } catch(PDOException $e) {
    return false;
  }
}

// Detects if user exists in the database
function userExists($username){
	global  $db;
	$stmt = $db->prepare('SELECT username FROM User WHERE username = :username');

	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	try{
    $stmt->execute();
		$result = $stmt->fetch();
		if($result['username'] != $username)
			return false;
		return true;
  } catch(PDOException $e) {
    return true;
  }
}

// user operarions
function user($operation, $username, $password, $name, $city){
	global $db;
	$secure_password = hash("sha256", $password);
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
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			$stmt->bindParam(':password', $secure_password, PDO::PARAM_STR);
			$stmt->execute();
			return;
		default:
			return;
	}

	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	$stmt->bindParam(':password', $secure_password, PDO::PARAM_STR);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':city', $city, PDO::PARAM_STR);
	$stmt->execute();
}

?>
