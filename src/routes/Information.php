<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->get('/information/getall', function(Request $request, Response $response){
	$sql = 'SELECT * FROM tbl_course_information';
	try {
		$db = new DataBase();
		$db = $db->connection();
		$result = $db->query($sql);

		if($result->rowCount() > 0) {
			$information['information'] = $result->fetchAll(PDO::FETCH_OBJ);

			return sendOkResponse(json_encode($information), $response);
		} else {
			return sendOkResponse(json_encode(['Error' => 'No existen datos en la base de datos.']), $response);
		}

		$result = null;
		$db = null;
	} catch(PDOException $e)  {
		return sendOkResponse(json_encode(['Error' => $e->getMessage()]), $response);
	}
});