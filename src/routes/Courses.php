<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Obtener lista de todos los cursos
$app->get('/courses/getall', function(Request $request, Response $response) {
	$sql = 'SELECT * FROM tbl_course';
	try {
		$db = new DataBase();
		$db = $db->connection();
		$result = $db->query($sql);
		$courses['courses'] = [];

		if($result->rowCount() > 0) {
			$courses['courses'] = $result->fetchAll(PDO::FETCH_OBJ);

			return sendOkResponse(json_encode($courses), $response);
		} else {
			return sendOkResponse(json_encode(['Error' => 'No existen datos en la base de datos.']), $response);
		}

		$result = null;
		$db = null;
	} catch(PDOException $e) {
		return sendOkResponse(json_encode(['Error' => $e->getMessage()]), $response);
	}
});

//Obtener lista de cursos favoritos
$app->get('/courses/getfavorites/{iduser}', function(Request $request, Response $response) {
	$idUser = $request->getAttribute("iduser");

	$sql = 'SELECT B.id, B.courseName, B.courseCode FROM tbl_favorite_courses A 
			INNER JOIN tbl_course B ON A.courseId = B.id AND userId = ' . $idUser;

	try {
		$db = new DataBase();
		$db = $db->connection();
		$result = $db->query($sql);

		if($result->rowCount() > 0) {
			$courses['courses'] = $result->fetchAll(PDO::FETCH_OBJ);

			return sendOkResponse(json_encode($courses), $response);
		} else {
			return sendOkResponse(json_encode(['Error' => 'No tienes cursos agregados.']), $response);
		}

		$result = null;
		$db = null;
	} catch(PDOException $e) {
		return sendOkResponse(json_encode(['Error' => $e->getMessage()]), $response);
	}
});

//agregar curso a lista de favoritos
$app->post("/courses/addfavorite", function(Request $request, Response $response)
{
	$userId = $request->getParam("userId");
	$courseId = $request->getParam("courseId");

	$sql = "INSERT INTO tbl_favorite_courses values (DEFAULT, NOW(), :userId, :courseId)";
	try {
		$db = new DataBase();
		$db = $db->Connection();
		$result = $db->prepare($sql);

		$result->bindParam("userId", $userId);
		$result->bindParam("courseId", $courseId);

		$result->execute();

		return sendOkResponse(json_encode(['Info' => 'Curso agregado con exito.']), $response);

		$result = null;
		$pdo = null;
	} catch(PDOException $e) {
		return sendOkResponse(json_encode(['Error' => $e->getMessage()]), $response);
	}
});

//Quitar curso a lista de favoritos
$app->delete("/courses/unfavoritecourse/{iduser}/{idcourse}", function(Request $request, Response $response)
{
	$idCourse = $request->getAttribute("idcourse");
	$idUser = $request->getAttribute("iduser");

	$sql = 'DELETE FROM tbl_favorite_courses WHERE userId = :idUser AND courseId = :idCourse';
	try {
		$pdo = new DataBase();
		$pdo = $pdo->Connection();
		$result = $pdo->prepare($sql);

		$result->bindParam('idCourse', $idCourse);
		$result->bindParam('idUser', $idUser);

		$result->execute();

		if($result->rowCount() > 0) {
			return sendOkResponse(json_encode(['Info' => 'Curso quitado con exito']), $response);
		} else {
			return sendOkResponse(json_encode(['Error' => 'No tienes el curso como favorito.']), $response);
		}

		$result = null;
		$pdo = null;
	} catch(PDOException $e) {
		return sendOkResponse(json_encode(['Error' => $e->getMessage()]), $response);
	}
});