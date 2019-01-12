<?php

require_once '../DataBase.php';

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

if(!empty($_GET['iduser']) && !empty($_GET['title']) && !empty($_GET['message']) && !empty($_GET['location'])  && !empty($_GET['date'])  && !empty($_GET['private'])) {

	$idUser = $_GET['iduser'];
	$title = $_GET['title'];
	$message = $_GET['message'];
	$location = $_GET['location'];
	$dateEvent = $_GET['dateEvent'];
	$private = $_GET['private'];

	$sql = "INSERT INTO tbl_event values (DEFAULT, :title, :message, :location, :dateEvent, :userId, :private, NOW())";
	try {
		$db = new DataBase();
		$db = $db->Connection();
		$result = $db->prepare($sql);

		$result->bindParam("userId", $idUser);
		$result->bindParam("title", $title);
		$result->bindParam("message", $message);
		$result->bindParam("location", $location);
		$result->bindParam("dateEvent", $dateEvent);
		$result->bindParam("private", $private);

		$result->execute();

		echo json_encode(['Info' => 'Evento Publicado con exito.']);

		$result = null;
		$pdo = null;
	} catch(PDOException $e) {
		echo json_encode(['Error' => 'Falta información.']);
	}
} else {
	echo json_encode(['Error' => 'Falta información.']);
}