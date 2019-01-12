<?php

require_once '../DataBase.php';

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

if(!empty($_GET['iduser']) && !empty($_GET['title']) && !empty($_GET['message'])) {
	$idUser = $_GET['iduser'];
	$title = $_GET['title'];
	$message = $_GET['message'];

	$sql = "INSERT INTO tbl_post values (DEFAULT, :title, :message, 0, NOW(), :userId)";
	try {
		$db = new DataBase();
		$db = $db->Connection();
		$result = $db->prepare($sql);

		$result->bindParam("title", $title);
		$result->bindParam("message", $message);
		$result->bindParam("userId", $idUser);

		$result->execute();

		echo json_encode(['Info' => 'Post Publicado con exito.']);

		$result = null;
		$pdo = null;
	} catch(PDOException $e) {
		echo json_encode(['Error' => 'Falta información.']);
	}
} else {
	echo json_encode(['Error' => 'Falta información.']);
}