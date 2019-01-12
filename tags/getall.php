<?php

require_once '../DataBase.php';

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

$sql = 'SELECT * FROM tbl_tag';
try {
	$db = new DataBase();
	$db = $db->connection();
	$result = $db->query($sql);
	$tag['tag'] = [];

	if($result->rowCount() > 0) {
		$tag['tag'] = $result->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($tag);
	} else {
		echo json_encode(['Error' => 'No existen datos en la base de datos.']);
	}

	$result = null;
	$db = null;
} catch(PDOException $e) {
	echo json_encode(['Error' => $e->getMessage()]);
}