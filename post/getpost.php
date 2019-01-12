<?php

require_once '../DataBase.php';

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');




if(!empty($_GET['idpost'])) {
	$idPost = $_GET['idpost'];

	$sql = 'SELECT A.*, B.username 
			FROM tbl_post A, tbl_user B 
			WHERE A.creatorid = B.id 
			AND A.id = ' . $idPost . ' OR A.parentpost = ' . $idPost . ' ORDER BY id ASC';

	try {
		$db = new DataBase();
		$db = $db->connection();
		$result = $db->query($sql);
		$post['post'] = [];

		if($result->rowCount() > 0) {
			$post['post'] = $result->fetchAll(PDO::FETCH_OBJ);

			echo json_encode($post);
		} else {
			echo json_encode(['Error' => 'Falta información.']);
		}

		$result = null;
		$db = null;
	} catch(PDOException $e) {
		echo json_encode(['Error' => $e->getMessage()]);
	}
} else {
	echo json_encode(['Error' => 'Falta información.']);
}