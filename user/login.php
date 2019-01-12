<?php

require_once '../DataBase.php';

// header('Content-type: application/json');
// header('Access-Control-Allow-Origin: *');

if(!empty($_GET['username']) && !empty($_GET['password'])) {
	$userName = $_GET['userName'];
	$password = $_GET['password'];

	try {
		$db = new DataBase();
		$db = $db->connection();
		$result = $db->prepare('SELECT * FROM tbl_user WHERE username = :userName');
		$result->bindParam(':userName', $userName);
		$result->execute();

		var_dump($result);
		// echo json_encode($user);

		if($user) {

			if($user['password'] == $password) {
				// echo json_encode(['Response' => 1]);
			} else {
				// echo json_encode(['Response' => 0]);
			}
		} else {
			// echo json_encode(['Response' => 0]);
		}

		$result = null;
		$db = null;
	} catch(PDOException $e) {
		echo json_encode(['Response' => 0]);
	}
} else {
	// echo json_encode(['Response' => 0]);
}