<?php

require_once '../DataBase.php';

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

if(!empty($_GET['iduser']) && !empty($_GET['idcourse'])) {
	$idUser = $_GET['iduser'];
	$idCourse = $_GET['idcourse'];

	$sql = "INSERT INTO tbl_favorite_courses values (DEFAULT, NOW(), :userId, :courseId)";
	try {
		$db = new DataBase();
		$db = $db->Connection();
		$result = $db->prepare($sql);

		$result->bindParam("userId", $idUser);
		$result->bindParam("courseId", $idCourse);

		$result->execute();

		echo json_encode(['Info' => 'Curso agregado con exito.']);

		$result = null;
		$pdo = null;
	} catch(PDOException $e) {
		echo json_encode(['Error' => 'No se ha ingresado el ID de usuario.']);
	}
} else {
	echo json_encode(['Error' => 'No se ha ingresado el ID de usuario o ID de Curso.']);
}