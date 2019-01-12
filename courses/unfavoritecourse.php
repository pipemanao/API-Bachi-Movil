<?php

require_once '../DataBase.php';

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

if(!empty($_GET['iduser']) && !empty($_GET['idcourse'])) {
	$idUser = $_GET['iduser'];
	$idCourse = $_GET['idcourse'];

	$sql = 'DELETE FROM tbl_favorite_courses WHERE userId = :idUser AND courseId = :idCourse';
	try {
		$pdo = new DataBase();
		$pdo = $pdo->Connection();
		$result = $pdo->prepare($sql);

		$result->bindParam('idCourse', $idCourse);
		$result->bindParam('idUser', $idUser);

		$result->execute();

		if($result->rowCount() > 0) {
			echo json_encode(['Info' => 'Curso quitado con exito']);
		} else {
			echo json_encode(['Error' => 'No tienes el curso como favorito.']);
		}
		$result = null;
		$pdo = null;
	} catch(PDOException $e) {
		echo json_encode(['Error' => 'No se ha ingresado el ID de usuario.']);
	}
} else {
	echo json_encode(['Error' => 'No se ha ingresado el ID de usuario o ID de Curso.']);
}



