<?php

require_once '../DataBase.php';

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

if(!empty($_GET['iduser'])) {
	$idUser = $_GET['iduser'];

	$sql = 'SELECT DISTINCT A.* FROM  tbl_course A, tbl_favorite_courses B 
				WHERE  A.id != B.courseId  AND B.userId = ' . $idUser;

	try {
		$db = new DataBase();
		$db = $db->connection();
		$result = $db->query($sql);

		if($result->rowCount() > 0) {
			$courses['courses'] = $result->fetchAll(PDO::FETCH_OBJ);

			echo json_encode($courses);
		} else {
			echo json_encode(['Error' => 'No existen datos en la base de datos.']);
		}

		$result = null;
		$db = null;
	} catch(PDOException $e) {
		echo json_encode(['Error' => $e->getMessage()]);
	}
} else {
	echo json_encode(['Error' => 'No se ha ingresado el ID de usuario.']);
}