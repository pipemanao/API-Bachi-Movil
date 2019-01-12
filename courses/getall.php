<?php

require_once '../DataBase.php';

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

$sql = 'SELECT * FROM tbl_course';
try {
	$db = new DataBase();
	$db = $db->connection();
	$result = $db->query($sql);
	$courses['courses'] = [];

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