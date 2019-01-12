<?php

require_once '../DataBase.php';

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

$sql = 'SELECT A.*, B.username 
		FROM tbl_post A, tbl_user B 
		WHERE A.creatorid = B.id 
		AND A.parentpost = ""';
try {
	$db = new DataBase();
	$db = $db->connection();
	$result = $db->query($sql);
	$post['post'] = [];

	if($result->rowCount() > 0) {
		$post['post'] = $result->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($post);
	} else {
		echo json_encode(['Error' => 'No existen datos en la base de datos.']);
	}

	$result = null;
	$db = null;
} catch(PDOException $e) {
	echo json_encode(['Error' => $e->getMessage()]);
}