<?php
include_once('connection.php');

// create a new user with the given parameters
function createUser($username, $password, $name, $city, $email, $phoneNumber){
	global $db;
	$stmt = $db->prepare('INSERT INTO User(username, password, name, city, email, phoneNumber) values (:username, :password, :name, :city, :email, :phoneNumber)');
	$secure_password = hash("sha256", $password);
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	$stmt->bindParam(':password', $secure_password, PDO::PARAM_STR);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':city', $city, PDO::PARAM_STR);
	$stmt->bindParam(':email', $email, PDO::PARAM_STR);
	$stmt->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);

	try{
    $stmt->execute();
		return true;
  } catch(PDOException $e) {
    return false;
  }
}

function editUser($username, $name, $city, $email, $phoneNumber, $password){
	global $db;

	if($password == "")
		$stmt = $db->prepare("UPDATE User SET name = :name , city = :city, email = :email, phoneNumber = :phoneNumber WHERE username = :username");
	else{
		$stmt = $db->prepare("UPDATE User SET name = :name , city = :city, email = :email, phoneNumber = :phoneNumber, password = :password WHERE username = :username");
		$secure_password = hash("sha256", $password);
		$stmt->bindParam(":password", $secure_password, PDO::PARAM_STR);
	}
	$stmt->bindParam(":username", $username, PDO::PARAM_STR);
	$stmt->bindParam(":name", $name, PDO::PARAM_STR);
	$stmt->bindParam(":city", $city, PDO::PARAM_STR);
	$stmt->bindParam(":email", $email, PDO::PARAM_STR);
	$stmt->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_STR);

	try{
		$stmt->execute();
		return true;
	} catch(PDOException $e){
		return false;
	}
}

// Detects if user/password combination exists
function authUser($username, $password){
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
    return "error";
  }
}

// Deletes a user from the database
function deleteUser($username){
	global  $db;
	$stmt = $db->prepare('DELETE FROM User WHERE username = :username');
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	try{
    	$stmt->execute();
		return true;
  } catch(PDOException $e) {
    return false;
  }
}

function getUser($username){
	global $db;
	$stmt = $db->prepare('SELECT username, city, name, phoneNumber, email FROM User WHERE username = :username');
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	try{
		$stmt->execute();
		$result = $stmt->fetch();
		if($result['username'] != $username)
			return false;
		return $result;
	} catch(PDOException $e){
		return false;
	}
}

?>
